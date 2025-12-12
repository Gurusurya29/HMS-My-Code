<?php

namespace App\Http\Livewire\Admin\Settings\User\Role;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Rolelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $role_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:roles,name,' . $this->role_id,
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
            if ($this->role_id) {
                $role = Role::find($this->role_id);
                $role->update($validatedData);
                // $user->roleupdatable()->save($role);
                Helper::trackmessage($user, $role, 'role_createoredit', session()->getId(), 'WEB', 'Role Setting Updated');
                $this->toaster('success', 'Role Setting Updated Successfully!!');
            } else {
                $role = Role::create($validatedData);
                Helper::trackmessage($user, $role, 'role_createoredit', session()->getId(), 'WEB', 'Role Setting Created');
                $this->toaster('success', 'Role Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_roles_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_roles_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_roles_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($roleid, $type)
    {
        if ($type == 'edit') {
            $role = Role::find($roleid);
            $this->name = $role->name;
            $this->note = $role->note;
            $this->active = $role->active;
            $this->role_id = $roleid;
        } else {
            $this->showdata = Role::find($roleid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->role_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $role = Role::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.settings.user.role.rolelivewire',
            compact('role'));
    }
}
