<?php

namespace App\Http\Livewire\Admin\Settings\User\User;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Auth\User;
use App\Models\Miscellaneous\Helper;
use DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Userlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    use WithFileUploads;

    public $name, $username, $phone, $email, $avatar, $role_id, $password, $password_confirmation, $note, $is_accountactive = false;
    public $user_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $this->user_id,
            'email' => 'nullable|email|unique:users,email,' . $this->user_id,
            'phone' => 'nullable|digits:10|numeric|unique:users,phone,' . $this->user_id,
            'avatar' => 'nullable|image|max:1024',
            'role_id' => 'required',
            'note' => 'nullable|max:255',
            'is_accountactive' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->roles_data = Role::where('active', true)->pluck('name', 'id');
    }

    protected function customvalidation()
    {
        $validatedData = $this->validate();

        if (!$this->user_id) {
            $validatedData = array_merge($validatedData,
                $this->validate(['password' => 'required|string|min:8|confirmed']));
        }
        return $validatedData;
    }

    public function store()
    {

        $validatedData = $this->customvalidation();
        $authuser = auth()->user();
        try {
            DB::beginTransaction();

            if ($this->user_id) {
                $user = User::find($this->user_id);
                $user->update($validatedData);
                DB::table('model_has_roles')->where('model_id', $this->user_id)->delete();
                $user->assignRole([$this->role_id]);
                $user->save();
                $authuser->adminupdatable()->save($user);
                Helper::trackmessage($authuser, $user, 'admin_user_createoredit', session()->getId(), 'WEB', 'User Updated');
                $this->toaster('success', 'User Updated Successfully!!');
            } else {
                $user = $authuser->admincreatable()
                    ->create($validatedData);
                $user->assignRole([$this->role_id]);
                Helper::trackmessage($authuser, $user, 'admin_user_createoredit', session()->getId(), 'WEB', 'User Created');
                $this->toaster('success', 'User Created Successfully!!');
            }

            if ($this->avatar) {
                ($authuser->avatar) ? Storage::delete('public/' . $authuser->avatar) : '';
                $saveimage = Image::make($this->avatar)
                    ->resize(150, 150)
                    ->encode('jpg', 90)
                    ->stream();

                $authuser->avatar = $path = 'admin/image/userprofile/' . time() . '.jpg';
                Storage::disk('public')->put($path, $saveimage, 'public');
                $authuser->save();
            }

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($authuser, 'admin_user_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($authuser, 'admin_user_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($authuser, 'admin_user_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function edit($user_id)
    {
        $this->formreset();
        $this->databind($user_id, 'edit');
        $this->dispatch('editmodal');
    }

    public function show($user_id)
    {
        $this->databind($user_id, 'show');
        $this->dispatch('showmodal');
    }

    protected function databind($user_id, $type)
    {

        if ($type == 'edit') {
            $user = User::find($user_id);
            $this->user_id = $user_id;
            $this->name = $user->name;
            $this->username = $user->username;
            $this->phone = $user->phone;
            $this->email = $user->email;
            $this->avatar = $user->avatar;
            $this->role_id = $user->role_id;
            $this->note = $user->note;
            $this->is_accountactive = $user->is_accountactive;
        } else {
            $this->showdata = User::find($user_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->username = $this->phone = $this->email
        = $this->avatar = $this->role_id = $this->password = $this->password_confirmation
        = $this->note = $this->user_id = null;
        $this->is_accountactive = false;
        $this->resetValidation();
    }

    public function render()
    {
        $user = User::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.settings.user.user.userlivewire', compact('user'));
    }
}
