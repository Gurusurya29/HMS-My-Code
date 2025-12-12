<?php

namespace App\Http\Livewire\Admin\Settings\Wardsetting\Wardtype;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Wardtypelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $ward_category, $note, $active = false;

    public $wardtype_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:wardtypes,name,' . $this->wardtype_id,
            'ward_category' => 'required',
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->wardtype_id) {
                $wardtype = Wardtype::find($this->wardtype_id);
                $wardtype->update($validatedData);
                $user->wardtypeupdatable()->save($wardtype);
                Helper::trackmessage($user, $wardtype, 'wardtype_createoredit', session()->getId(), 'WEB', 'Ward Type Setting Updated');
                $this->toaster('success', 'Ward Type Setting Updated Successfully!!');
            } else {
                $wardtype = $user->wardtypecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $wardtype, 'wardtype_createoredit', session()->getId(), 'WEB', 'Ward Type Setting Created');
                $this->toaster('success', 'Ward Type Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_wardtypes_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_wardtypes_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_wardtypes_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($wardtypeid, $type)
    {
        if ($type == 'edit') {
            $wardtype = Wardtype::find($wardtypeid);
            $this->name = $wardtype->name;
            $this->note = $wardtype->note;
            $this->active = $wardtype->active;
            $this->ward_category = $wardtype->ward_category;
            $this->wardtype_id = $wardtypeid;
        } else {
            $this->showdata = Wardtype::find($wardtypeid);
        }
    }

    public function formreset()
    {
        $this->name = $this->ward_category = $this->note = $this->wardtype_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $wardtypelist = Wardtype::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.wardsetting.wardtype.wardtypelivewire',
            compact('wardtypelist'));
    }
}
