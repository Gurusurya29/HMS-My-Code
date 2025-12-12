<?php

namespace App\Http\Livewire\Admin\Settings\Generalsetting\Themesetting;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Generalsettings\Themesetting;
use App\Models\Miscellaneous\Helper;
use Livewire\Component;

class Themesettinglivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $gateway_id, $gateway_name, $gateway_username, $gateway_secret_key, $gateway_publisher_key, $is_default, $note;
    public $themesetting_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'theme_name' => 'required|min:3|max:70',
            'path' => 'required|max:70',
            'is_default' => 'nullable|boolean',
            'note' => 'nullable|max:255',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        ($this->is_default == 1) ? Themesetting::where('is_default', true)->update(['is_default' => false]) : null;

        try {

            if ($this->themesetting_id) {
                $themesetting = Themesetting::find($this->themesetting_id);
                $themesetting->update($validatedData);
                $user->themesettingupdatable()->save($themesetting);
                Helper::trackmessage($user, $themesetting, 'themesetting_createoredit', session()->getId(), 'WEB', 'Theme Setting Updated');
                $this->toaster('success', 'Theme Setting Updated Successfully!!');
            } else {
                $themesetting = $user->themesettingcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $themesetting, 'themesetting_createoredit', session()->getId(), 'WEB', 'Theme Setting Created');
                $this->toaster('success', 'Theme Setting Created Successfully!!');
            }

            $this->formreset();
            $this->dispatch('closemodal');

        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_themesettings_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_themesettings_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_themesettings_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($themesettingid, $type)
    {
        if ($type == 'edit') {
            $themesetting = Themesetting::find($themesettingid);
            $this->theme_name = $themesetting->theme_name;
            $this->path = $themesetting->path;
            $this->is_default = $themesetting->is_default;
            $this->note = $themesetting->note;
            $this->themesetting_id = $themesettingid;
        } else {
            $this->showdata = Themesetting::find($themesettingid);
        }
    }

    public function formreset()
    {
        $this->theme_name = $this->path = $this->is_default =
        $this->note = $this->themesetting_id = null;

        $this->resetValidation();
    }

    public function render()
    {
        $themesetting = Themesetting::query()
            ->where(function ($query) {
                $query->where('theme_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.settings.generalsetting.themesetting.themesettinglivewire',
            compact('themesetting'));
    }
}
