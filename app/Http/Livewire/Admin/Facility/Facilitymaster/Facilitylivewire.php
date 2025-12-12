<?php

namespace App\Http\Livewire\Admin\Facility\Facilitymaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Facility\Facility;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Facilitylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $assetid, $location, $location_comment,
    $manufacture, $model_no, $serial_no, $installation_date,
    $supplied_date, $asset_type, $asset_description, $supplied_by_vendor,
    $asset_install_verifiedby, $asset_comment, $asset_condition,
    $warranty_exp_date, $warranty_contact_person, $asset_custodian,
    $active = false;

    public $facility_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:facilities,name,' . $this->facility_id,
            'assetid' => 'nullable|max:70',
            'location' => 'nullable|max:70',
            'location_comment' => 'nullable|max:70',
            'manufacture' => 'nullable|max:70',
            'model_no' => 'nullable|max:70',
            'serial_no' => 'nullable|max:70',
            'installation_date' => 'nullable|date',
            'supplied_date' => 'nullable|date',
            'asset_type' => 'nullable|max:70',
            'asset_description' => 'nullable|max:70',
            'supplied_by_vendor' => 'nullable|max:70',
            'asset_install_verifiedby' => 'nullable|max:70',
            'asset_comment' => 'nullable|max:70',
            'asset_condition' => 'nullable',
            'warranty_exp_date' => 'nullable|date',
            'warranty_contact_person' => 'nullable|max:70',
            'asset_custodian' => 'nullable',
            'active' => 'nullable|boolean',
            'note' => 'nullable|max:255',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = $this->currentuser();
        try {
            DB::beginTransaction();
            if ($this->facility_id) {
                $facility = Facility::find($this->facility_id);
                $facility->update($validatedData);
                $user->facilityupdatable()->save($facility);
                Helper::trackmessage($user, $facility, 'facility_createoredit', session()->getId(), 'WEB', 'Facility Updated');
                $this->toaster('success', 'Facility Updated Successfully!!');
            } else {
                $facility = $user->facilitycreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $facility, 'facility_createoredit', session()->getId(), 'WEB', 'Facility Created');
                $this->toaster('success', 'Facility Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'hms_facility_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'hms_facility_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'hms_facility_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($facilityid, $type)
    {
        if ($type == 'edit') {
            $facility = Facility::find($facilityid);
            $this->name = $facility->name;
            $this->note = $facility->note;
            $this->active = $facility->active;
            $this->facility_id = $facilityid;
            $this->assetid = $facility->assetid;
            $this->location = $facility->location;
            $this->location_comment = $facility->location_comment;
            $this->manufacture = $facility->manufacture;
            $this->model_no = $facility->model_no;
            $this->serial_no = $facility->serial_no;
            $this->installation_date = $facility->installation_date;
            $this->supplied_date = $facility->supplied_date;
            $this->asset_type = $facility->asset_type;
            $this->asset_description = $facility->asset_description;
            $this->supplied_by_vendor = $facility->supplied_by_vendor;
            $this->asset_install_verifiedby = $facility->asset_install_verifiedby;
            $this->asset_comment = $facility->asset_comment;
            $this->asset_condition = $facility->asset_condition;
            $this->warranty_exp_date = $facility->warranty_exp_date;
            $this->warranty_contact_person = $facility->warranty_contact_person;
            $this->asset_custodian = $facility->asset_custodian;

        } else {
            $this->showdata = Facility::find($facilityid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->active = $this->facility_id =
        $this->assetid = $this->location = $this->location_comment = $this->manufacture =
        $this->model_no = $this->serial_no = $this->installation_date =
        $this->supplied_date = $this->asset_type = $this->asset_description =
        $this->supplied_by_vendor = $this->asset_install_verifiedby =
        $this->asset_comment = $this->asset_condition = $this->warranty_exp_date =
        $this->warranty_contact_person = $this->asset_custodian = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $facility = Facility::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.facility.facilitymaster.facilitylivewire',
            compact('facility'));
    }

}
