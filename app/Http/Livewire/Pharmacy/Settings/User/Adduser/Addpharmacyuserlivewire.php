<?php

namespace App\Http\Livewire\Pharmacy\Settings\User\Adduser;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Auth\Pharmacy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Addpharmacyuserlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    use WithFileUploads;

    public $name, $username, $phone, $email, $avatar,
    $password, $password_confirmation, $note, $is_accountactive = false, $role;
    public $pharmacy_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:pharmacies,username,' . $this->pharmacy_id,
            'email' => 'nullable|email|unique:pharmacies,email,' . $this->pharmacy_id,
            'phone' => 'required|digits:10|numeric|unique:pharmacies,phone,' . $this->pharmacy_id,
            'avatar' => 'nullable|image|max:1024',
            'note' => 'nullable|max:255',
            'role' => 'required',
            'is_accountactive' => 'nullable|boolean',
        ];
    }

    protected function customvalidation()
    {
        $validatedData = $this->validate();

        if (!$this->pharmacy_id) {
            $validatedData = array_merge($validatedData,
                $this->validate(['password' => 'required|string|min:8|confirmed']));
        }
        return $validatedData;
    }

    public function store()
    {

        $validatedData = $this->customvalidation();
        try {
            DB::beginTransaction();

            if ($this->pharmacy_id) {

                $pharmacy = Pharmacy::find($this->pharmacy_id);
                $pharmacy->update($validatedData);
                $this->currentuser()->pharmacyupdatable()->save($pharmacy);

                Helper::trackmessage($this->currentuser(), $pharmacy, 'pharmacy_pharmacy_createoredit', session()->getId(), 'WEB', 'Pharmacy Updated');
                $this->toaster('success', 'Pharmacy Updated Successfully!!');
            } else {
                $pharmacy = $this->currentuser()->pharmacycreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $pharmacy, 'pharmacy_pharmacy_createoredit', session()->getId(), 'WEB', 'Pharmacy Created');
                $this->toaster('success', 'Pharmacy Created Successfully!!');
            }

            if ($this->avatar) {
                ($this->currentuser()->avatar) ? Storage::delete('public/' . $this->currentuser()->avatar) : '';
                $saveimage = Image::make($this->avatar)
                    ->resize(150, 150)
                    ->encode('jpg', 90)
                    ->stream();

                $this->currentuser()->avatar = $path = 'pharmacy/image/userprofile/' . time() . '.jpg';
                Storage::disk('public')->put($path, $saveimage, 'public');
                $this->currentuser()->save();
            }

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacy_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacy_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_pharmacy_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function edit($pharmacy_id)
    {
        $this->formreset();
        $this->databind($pharmacy_id, 'edit');
        $this->dispatch('editmodal');
    }

    public function show($pharmacy_id)
    {
        $this->databind($pharmacy_id, 'show');
        $this->dispatch('showmodal');
    }

    protected function databind($pharmacy_id, $type)
    {

        if ($type == 'edit') {
            $pharmacy = Pharmacy::find($pharmacy_id);
            $this->pharmacy_id = $pharmacy_id;
            $this->name = $pharmacy->name;
            $this->username = $pharmacy->username;
            $this->phone = $pharmacy->phone;
            $this->email = $pharmacy->email;
            $this->avatar = $pharmacy->avatar;
            $this->note = $pharmacy->note;
            $this->role = $pharmacy->role;
            $this->is_accountactive = $pharmacy->is_accountactive;
        } else {
            $this->showdata = Pharmacy::find($pharmacy_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->username = $this->phone = $this->email
        = $this->avatar = $this->password = $this->password_confirmation
        = $this->note = $this->pharmacy_id = null;
        $this->is_accountactive = false;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmacy = Pharmacy::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.pharmacy.settings.user.adduser.addpharmacyuserlivewire', compact('pharmacy'));
    }
}
