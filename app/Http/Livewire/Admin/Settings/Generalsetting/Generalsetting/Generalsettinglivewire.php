<?php

namespace App\Http\Livewire\Admin\Settings\Generalsetting\Generalsetting;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Generalsettings\Generalsetting;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Generalsettinglivewire extends Component
{
    use miscellaneousLivewireTrait;
    use WithFileUploads;

    public $companyfullname, $companyshortname, $phone, $email, $alternate_phone, $gstno, $panno, $hospitalcode, $websitename, $address;
    public $logo, $existinglogo;
    public $favicon, $existingfavicon;

    public function mount()
    {
        $this->databind();
    }

    protected function rules()
    {
        return [
            'companyfullname' => 'bail|required|max:70',
            'companyshortname' => 'bail|required|max:70',
            'address' => 'bail|required|max:255',
            'phone' => 'bail|required|min:7|max:13',
            'alternate_phone' => 'bail|nullable|min:7|max:13',
            'email' => 'bail|required|email',
            'gstno' => 'bail|nullable',
            'panno' => 'bail|nullable',
            'hospitalcode' => 'bail|nullable',
            'websitename' => 'bail|nullable',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            $generalsetting = Generalsetting::first();
            $generalsetting->update($validatedData);
            Helper::trackmessage(auth()->user(), $generalsetting, 'generalsetting_createoredit', session()->getId(), 'WEB', 'General Setting Updated');
            $this->toaster('success', 'General Settings Updated Successfully!!');
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_general_settings', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_general_settings', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_general_settings', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind()
    {
        $generalsetting = Generalsetting::first();
        $this->companyfullname = $generalsetting->companyfullname;
        $this->companyshortname = $generalsetting->companyshortname;
        $this->phone = $generalsetting->phone;
        $this->email = $generalsetting->email;
        $this->alternate_phone = $generalsetting->alternate_phone;
        $this->gstno = $generalsetting->gstno;
        $this->panno = $generalsetting->panno;
        $this->hospitalcode = $generalsetting->hospitalcode;
        $this->websitename = $generalsetting->websitename;
        $this->address = $generalsetting->address;
        $this->existinglogo = $generalsetting->logo;
        $this->existingfavicon = $generalsetting->favicon;
    }

    protected function formreset()
    {
        $companyfullname = $companyshortname = $phone = $email = $alternate_phone = $gstno = $panno = $hospitalcode = $websitename = $address = null;
        $this->resetValidation();
    }

    public function onclickformreset()
    {
        $this->databind();
        $this->resetValidation();
        $this->toaster('warning', 'Oops! General Settings Discarded Done');
    }

    public function uploadlogo()
    {
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        $path = 'image/logo';
        $newlogo = $this->logo->store($path, 'public');
        Generalsetting::first()->update(['logo' => $newlogo]);
        if ($this->existinglogo) {
            Storage::delete('public/' . $this->existinglogo);
        }
        $this->logo = null;
        $this->existinglogo = $newlogo;
        $this->toaster('success', 'Logo Uploaded Successfully!');
    }

    public function uploadfavicon()
    {
        $this->validate([
            'favicon' => 'image|max:1024', // 1MB Max
        ]);

        $path = 'image/favicon';
        $newfavicon = $this->favicon->store($path, 'public');
        Generalsetting::first()->update(['favicon' => $newfavicon]);
        if ($this->existingfavicon) {
            Storage::delete('public/' . $this->existingfavicon);
        }
        $this->favicon = null;
        $this->existingfavicon = $newfavicon;
        $this->toaster('success', 'Favicon Uploaded Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.settings.generalsetting.generalsetting.generalsettinglivewire');
    }
}
