<?php

namespace App\Http\Livewire\Admin\Settings\Suppliersetting\Supplier\Createoredit;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Patientregisterationsetting\Country;
use App\Models\Admin\Settings\Patientregisterationsetting\State;
use App\Models\Admin\Settings\Supplier\Supplier;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Suppliercreatelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $supplier_id;

    public $company_name, $note, $company_person_name, $contact_mobile_no,
    $contact_phone_no, $email, $address, $country_id, $state_id, $city,
    $pincode, $gstin, $pan, $bank_name, $bank_ifsc, $bank_branch, $bank_ac_number,
    $is_equipment = false, $is_inventory = false, $is_canteen = false;

    public $is_hms = false, $is_pharmacy = false, $is_laboratory = false, $active = false;

    public $countrylist, $statelist;

    protected $listeners = [
        'formreset',
        'supplier-edit' => 'edit',
    ];

    public function mount()
    {
        $this->country_id = 101;
        $this->state_id = State::where('code', 'TN')->first()->id;

        $this->statelist = State::where('country_id', 101)->where('active', true)->pluck('name', 'id');
        $this->countrylist = Country::where('active', true)->pluck('name', 'id');
    }

    protected function rules()
    {
        return [
            'company_name' => 'required|unique:suppliers,company_name,' . $this->supplier_id,
            'company_person_name' => 'required|min:2|max:70',
            'contact_mobile_no' => 'required|numeric',
            'contact_phone_no' => 'nullable|numeric',
            'email' => 'nullable|email',
            'address' => 'required|min:2|max:70',
            'country_id' => 'nullable',
            'state_id' => 'nullable',
            'city' => 'nullable',
            'pincode' => 'nullable|numeric',
            'gstin' => 'nullable|size:15',
            'pan' => 'nullable|size:10',
            'bank_name' => 'nullable',
            'bank_ifsc' => 'nullable',
            'bank_branch' => 'nullable',
            'bank_ac_number' => 'nullable',
            'note' => 'nullable|max:255',
            'is_hms' => 'nullable',
            'is_pharmacy' => 'nullable',
            'is_laboratory' => 'nullable',
            'active' => 'nullable',
            'is_equipment' => 'nullable|boolean',
            'is_inventory' => 'nullable|boolean',
            'is_canteen' => 'nullable|boolean',
        ];
    }

    public function formreset()
    {
        $this->company_name = $this->note = $this->supplier_id =
        $this->company_person_name = $this->contact_mobile_no = $this->contact_phone_no =
        $this->email = $this->address = $this->city = $this->pincode =
        $this->gstin = $this->pan = $this->bank_name = $this->bank_ifsc =
        $this->bank_branch = $this->bank_ac_number = null;
        $this->is_hms = $this->is_pharmacy = $this->is_laboratory = $this->active =
        $this->is_equipment = $this->is_inventory = $this->is_canteen = false;

        $this->country_id = 101;
        $this->state_id = State::where('code', 'TN')->first()->id;

        $this->statelist = State::where('country_id', 101)->where('active', true)->pluck('name', 'id');
        $this->resetValidation();
    }

    public function updatedCountryId()
    {
        $this->statelist = State::where('country_id', $this->country_id)->where('active', true)->pluck('name', 'id');
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->supplier_id) {

                $supplier = Supplier::find($this->supplier_id);
                $supplier->update($validatedData);
                $this->currentuser()->supplierupdatable()->save($supplier);

                Helper::trackmessage($this->currentuser(), $supplier, 'supplier_createoredit', session()->getId(), 'WEB', 'Supplier Updated');
                $this->toaster('success', 'Supplier Updated Successfully!!');
            } else {
                $supplier = $this->currentuser()->suppliercreatable()->create($validatedData);
                Helper::trackmessage($this->currentuser(), $supplier, 'supplier_createoredit', session()->getId(), 'WEB', 'Supplier Created');
                $this->toaster('success', 'Supplier Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
            $this->dispatch('rerenderindex');
        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'suppliers_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'suppliers_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'suppliers_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function edit($supplier)
    {
        $this->company_name = $supplier['company_name'];
        $this->note = $supplier['note'];
        $this->supplier_id = $supplier['id'];
        $this->company_person_name = $supplier['company_person_name'];
        $this->contact_mobile_no = $supplier['contact_mobile_no'];
        $this->contact_phone_no = $supplier['contact_phone_no'];
        $this->email = $supplier['email'];
        $this->address = $supplier['address'];
        $this->country_id = $supplier['country_id'];
        $this->state_id = $supplier['state_id'];
        $this->city = $supplier['city'];
        $this->pincode = $supplier['pincode'];
        $this->gstin = $supplier['gstin'];
        $this->pan = $supplier['pan'];
        $this->bank_name = $supplier['bank_name'];
        $this->bank_ifsc = $supplier['bank_ifsc'];
        $this->bank_branch = $supplier['bank_branch'];
        $this->bank_ac_number = $supplier['bank_ac_number'];
        $this->is_hms = $supplier['is_hms'];
        $this->is_pharmacy = $supplier['is_pharmacy'];
        $this->is_laboratory = $supplier['is_laboratory'];
        $this->active = $supplier['active'];
        $this->is_equipment = $supplier['is_equipment'];
        $this->is_inventory = $supplier['is_inventory'];
        $this->is_canteen = $supplier['is_canteen'];
    }

    public function render()
    {
        return view('livewire.admin.settings.suppliersetting.supplier.createoredit.suppliercreatelivewire');
    }
}
