<?php

namespace App\Http\Livewire\Admin\Settings\Wardsetting\Bedorroomnumber;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Bedorroomnumberlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $wardtype_id, $wardfloor_id, $name, $insurancefee, $selffee, $note, $is_ot = false, $active = false;

    public $wardtypeoption, $wardflooroption;

    public $bedorroomnumber_id;
    public $showdata;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->wardtypeoption = Wardtype::where('active', true)->pluck('name', 'id');
        $this->wardflooroption = Wardfloor::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:bedorroomnumbers,name,' . $this->bedorroomnumber_id,
            'wardtype_id' => 'required',
            'wardfloor_id' => 'required',
            'insurancefee' => 'required|numeric',
            'selffee' => 'required|numeric',
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
            'is_ot' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->bedorroomnumber_id) {
                $bedorroomnumber = Bedorroomnumber::find($this->bedorroomnumber_id);
                $bedorroomnumber->update($validatedData);
                $user->bedorroomnumberupdatable()->save($bedorroomnumber);
                Helper::trackmessage($user, $bedorroomnumber, 'bedorroomnumber_createoredit', session()->getId(), 'WEB', 'Bed Or Room Number Setting Updated');
                $this->toaster('success', 'Bed Or Room Number Setting Updated Successfully!!');
            } else {
                $validatedData['is_available'] = 0;
                $bedorroomnumber = $user->bedorroomnumbercreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $bedorroomnumber, 'bedorroomnumber_createoredit', session()->getId(), 'WEB', 'Bed Or Room Number Setting Created');
                $this->toaster('success', 'Bed Or Room Number Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_bedorroomnumbers_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_bedorroomnumbers_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_bedorroomnumbers_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($bedorroomnumberid, $type)
    {
        if ($type == 'edit') {
            $bedorroomnumber = Bedorroomnumber::find($bedorroomnumberid);
            $this->name = $bedorroomnumber->name;
            $this->insurancefee = $bedorroomnumber->insurancefee;
            $this->selffee = $bedorroomnumber->selffee;
            $this->wardtype_id = $bedorroomnumber->wardtype_id;
            $this->wardfloor_id = $bedorroomnumber->wardfloor_id;
            $this->note = $bedorroomnumber->note;
            $this->active = $bedorroomnumber->active;
            $this->is_ot = $bedorroomnumber->is_ot;
            $this->bedorroomnumber_id = $bedorroomnumberid;
        } else {
            $this->showdata = Bedorroomnumber::find($bedorroomnumberid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->insurancefee = $this->selffee = $this->wardtype_id = $this->wardfloor_id = $this->bedorroomnumber_id = null;
        $this->active = $this->is_ot = false;
        $this->resetValidation();
    }

    public function render()
    {
        $bedorroomnumber = Bedorroomnumber::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.wardsetting.bedorroomnumber.bedorroomnumberlivewire',
            compact('bedorroomnumber'));
    }
}
