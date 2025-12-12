<?php

namespace App\Http\Livewire\Admin\Settings\User\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissionlivewire extends Component
{
    public $role;
    public $selectallstatus = false;

    public function mount($id)
    {
        $this->role = Role::find($id);
    }

    public function markpermission($permissionid)
    {
        if ($this->role->hasPermissionTo($permissionid)) {
            $this->role->revokePermissionTo($permissionid);
            $this->toaster('error', 'Permission Revoked!!');
        } else {
            $this->role->givePermissionTo($permissionid);
            $this->toaster('success', 'Permission Granted!!');
        }
    }

    public function updatingSelectallstatus()
    {
        if ($this->selectallstatus) {
            $this->role->syncPermissions([]);
            $this->toaster('error', 'All Permission Revoked!!');
            $this->selectallstatus = false;
        } else {
            $this->role->syncPermissions(Permission::pluck('id'));
            $this->toaster('success', 'All Permission Granted!!');
            $this->selectallstatus = true;
        }
    }

    protected function toaster($type, $message)
    {
        $this->dispatchBrowserEvent('alert',
            ['type' => $type, 'message' => $message]);
    }

    public function render()
    {
        $permission = Permission::all();
        return view('livewire.admin.settings.user.role.permissionlivewire',
            compact('permission'));
    }
}
