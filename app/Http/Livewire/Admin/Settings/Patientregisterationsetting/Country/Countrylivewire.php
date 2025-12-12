<?php

namespace App\Http\Livewire\Admin\Settings\Patientregisterationsetting\Country;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Countrylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $code, $active = false;

    public $country_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:countries,name,' . $this->country_id,
            'code' => 'required|min:2|max:5',
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
            if ($this->country_id) {
                $country = Country::find($this->country_id);
                $country->update($validatedData);
                $user->countryupdatable()->save($country);
                Helper::trackmessage($user, $country, 'country_createoredit', session()->getId(), 'WEB', 'Country Setting Updated');
                $this->toaster('success', 'Country Setting Updated Successfully!!');
            } else {
                $country = $user->countrycreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $country, 'country_createoredit', session()->getId(), 'WEB', 'Country Setting Created');
                $this->toaster('success', 'Country Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_country_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_country_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_country_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($countryid, $type)
    {
        if ($type == 'edit') {
            $country = Country::find($countryid);
            $this->name = $country->name;
            $this->code = $country->code;
            $this->note = $country->note;
            $this->active = $country->active;
            $this->country_id = $countryid;
        } else {
            $this->showdata = Country::find($countryid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->code = $this->country_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $country = Country::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.patientregisterationsetting.country.countrylivewire', compact('country'));
    }
}
