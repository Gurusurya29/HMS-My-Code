<?php

namespace App\Http\Livewire\Livewirehelper\Miscellaneous;

use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait miscellaneousLivewireTrait
{
    public $dob;
    public $doj;
    public $education_qualification;
    public $previous_organisation;
    public $experience; 
    public $aadhar_no;
    public $pan_no;
    public $bank_name; 
    public $bank_account_no;
    public $bank_ifsc_code;
    public $bank_branch;
    public $pharmacymanufacture_id;
    public $pharmacygenaric_id;
    public $purchase_date;
    public function currentuser()
    {
        if (auth()->check()) {
            return auth()->user();
        } else if (auth()->guard('pharmacy')->check()) {
            return auth()->guard('pharmacy')->user();
        } else if (auth()->guard('laboratory')->check()) {
            return auth()->guard('laboratory')->user();
        } else {
            return redirect('/');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // protected function toaster($type, $message)
    // {
    //     $this->dispatchBrowserEvent('alert',
    //         ['type' => $type, 'message' => $message]);
    // }

    protected function toaster($type, $message)
    {
        $this->dispatch('alert', type: $type, message: $message);
    }

    protected function exceptionerror($user, $function, $trackmsg)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $function . ' ' . $trackmsg);
        Helper::trackmessage($user, $trackmsg, $function, session()->getId(), 'WEB');
        $this->toaster('error', $e->getMessage());
    }
}
