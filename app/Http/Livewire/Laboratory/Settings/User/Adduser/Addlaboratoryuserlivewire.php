<?php

namespace App\Http\Livewire\Laboratory\Settings\User\Adduser;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Laboratory\Auth\Laboratory;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Addlaboratoryuserlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    use WithFileUploads;

    public $name, $username, $phone, $email, $avatar, $password,
    $password_confirmation, $note, $access_lab = false,
    $access_scan = false, $access_xray = false, $active = false;

    public $laboratory_id;
    public $showdata;
    public $role = 'user';

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:laboratories,username,' . $this->laboratory_id,
            'email' => 'nullable|email|unique:laboratories,email,' . $this->laboratory_id,
            'phone' => 'required|digits:10|numeric|unique:laboratories,phone,' . $this->laboratory_id,
            'avatar' => 'nullable|image|max:1024',
            'note' => 'nullable|max:255',
            'role' => 'required',
            'access_lab' => 'nullable|boolean',
            'access_scan' => 'nullable|boolean',
            'access_xray' => 'nullable|boolean',
            'active' => 'nullable|boolean',
        ];
    }

    protected function customvalidation()
    {
        $validatedData = $this->validate();

        if (!$this->laboratory_id) {
            $validatedData = array_merge($validatedData,
                $this->validate(['password' => 'required|string|min:8|confirmed']));
        }
        return $validatedData;
    }

    public function store()
    {

        $validatedData = $this->customvalidation();
        $user = auth()->guard('laboratory')->user();
        try {
            DB::beginTransaction();

            if ($this->laboratory_id) {
                $laboratory = Laboratory::find($this->laboratory_id);
                $laboratory->update($validatedData);
                $user->laboratoryupdatable()->save($laboratory);
                Helper::trackmessage($user, $laboratory, 'laboratory_laboratory_createoredit', session()->getId(), 'WEB', 'Laboratory Updated');
                $this->toaster('success', 'Laboratory Updated Successfully!!');
            } else {
                $laboratory = $user->laboratorycreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $laboratory, 'laboratory_laboratory_createoredit', session()->getId(), 'WEB', 'Laboratory Created');
                $this->toaster('success', 'Laboratory Created Successfully!!');
            }

            if ($this->avatar) {
                ($laboratory->avatar) ? Storage::delete('public/' . $laboratory->avatar) : '';
                $saveimage = Image::make($this->avatar)
                    ->resize(150, 150)
                    ->encode('jpg', 90)
                    ->stream();

                $laboratory->avatar = $path = 'laboratory/image/userprofile/' . time() . '.jpg';
                Storage::disk('public')->put($path, $saveimage, 'public');
                $laboratory->save();
            }

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_laboratory_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_laboratory_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_laboratory_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function edit($laboratory_id)
    {
        $this->formreset();
        $this->databind($laboratory_id, 'edit');
        $this->dispatch('editmodal');
    }

    public function show($laboratory_id)
    {
        $this->databind($laboratory_id, 'show');
        $this->dispatch('showmodal');
    }

    protected function databind($laboratory_id, $type)
    {

        if ($type == 'edit') {
            $laboratory = Laboratory::find($laboratory_id);
            $this->laboratory_id = $laboratory_id;
            $this->name = $laboratory->name;
            $this->username = $laboratory->username;
            $this->phone = $laboratory->phone;
            $this->email = $laboratory->email;
            $this->avatar = $laboratory->avatar;
            $this->note = $laboratory->note;

            $this->role = $laboratory->role;
            $this->access_lab = $laboratory->access_lab;
            $this->access_scan = $laboratory->access_scan;
            $this->access_xray = $laboratory->access_xray;
            $this->active = $laboratory->active;
        } else {
            $this->showdata = Laboratory::find($laboratory_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->username = $this->phone = $this->email =
        $this->avatar = $this->password = $this->password_confirmation =
        $this->note = $this->laboratory_id = $this->access_lab = null;
        $this->access_lab = false;
        $this->access_scan = false;
        $this->access_xray = false;
        $this->active = false;
        $this->password = '';
        $this->role = 'user';
        $this->resetValidation();
    }

    public function render()
    {
        $laboratory = Laboratory::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('role', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.laboratory.settings.user.adduser.addlaboratoryuserlivewire', compact('laboratory'));
    }
}
