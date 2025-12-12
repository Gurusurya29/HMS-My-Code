<?php

namespace App\Http\Livewire\Laboratory\Settings\User\Changepassword;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Laboratorychangepasswordlivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $currentpassword, $password, $password_confirmation;

    protected $rules = [
        'currentpassword' => 'bail|required',
        'password' => 'bail|required|confirmed|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function changepassword()
    {
        try {
            DB::beginTransaction();

            $validatedData = $this->validate();

            $user = auth()->guard('laboratory')->user();

            if (Hash::check($this->currentpassword, $user->password)) {

                $user->update(['password' => $this->password]);
                Helper::trackmessage($user, 'Laboratory Change Password', 'laboratory_web_changepassword', session()->getId(), 'WEB', 'Password Changed');
                DB::commit();

                $this->formreset();
                $this->toaster('success', 'Change Password Successfully!!');
            } else {
                DB::rollback();
                $this->formreset();
                $this->toaster('error', 'Invalid Credentials, Please Try Again');
            }

        } catch (Exception $e) {
            $this->exceptionerror($user, 'laboratory_change_password', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'laboratory_change_password', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'laboratory_change_password', 'error_three : ' . $e->getMessage());
        }

    }

    public function onclickformreset()
    {
        $this->formreset();
        $this->toaster('warning', 'Oops! Change Password Discarded Done');
    }

    public function formreset()
    {
        $this->password = $this->password_confirmation = $this->currentpassword = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.laboratory.settings.user.changepassword.laboratorychangepasswordlivewire');
    }
}
