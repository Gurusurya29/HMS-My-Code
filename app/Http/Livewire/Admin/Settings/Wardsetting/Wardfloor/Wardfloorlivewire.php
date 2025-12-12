<?php

namespace App\Http\Livewire\Admin\Settings\Wardsetting\Wardfloor;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Wardsetting\Wardfloor;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Wardfloorlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $wardfloor_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:wardfloors,name,' . $this->wardfloor_id,
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
            if ($this->wardfloor_id) {
                $wardfloor = Wardfloor::find($this->wardfloor_id);
                $wardfloor->update($validatedData);
                $user->wardfloorupdatable()->save($wardfloor);
                Helper::trackmessage($user, $wardfloor, 'wardfloor_createoredit', session()->getId(), 'WEB', 'Ward Floor Setting Updated');
                $this->toaster('success', 'Ward Floor Setting Updated Successfully!!');
            } else {
                $wardfloor = $user->wardfloorcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $wardfloor, 'wardfloor_createoredit', session()->getId(), 'WEB', 'Ward Floor Setting Created');
                $this->toaster('success', 'Ward Floor Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_wardfloors_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_wardfloors_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_wardfloors_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($wardfloorid, $type)
    {
        if ($type == 'edit') {
            $wardfloor = Wardfloor::find($wardfloorid);
            $this->name = $wardfloor->name;
            $this->note = $wardfloor->note;
            $this->active = $wardfloor->active;
            $this->wardfloor_id = $wardfloorid;
        } else {
            $this->showdata = Wardfloor::find($wardfloorid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->wardfloor_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $wardfloor = Wardfloor::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.wardsetting.wardfloor.wardfloorlivewire',
            compact('wardfloor'));
    }
}
