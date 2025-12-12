<?php

namespace App\Http\Livewire\Pharmacy\Sales\Salesentry;

use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Prescription\Prescription;
use App\Models\Admin\Settings\Doctorsetting\Doctor;
use App\Models\Miscellaneous\Helper;
use App\Models\Patient\Auth\Patient;
use App\Models\Pharmacy\Purchase\Purchaseentry\Pharmpurchaseentryitem;
use App\Models\Pharmacy\Sales\Salesentry\Pharmsalesentryitem;
use App\Models\Pharmacy\Settings\Product\Pharmacyproduct;
use App\Models\Pharmacy\Settings\Product\Pharmproductinventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Livewire\Component;

class Salesentrycreatelivewire extends Component
{
    use miscellaneousLivewireTrait;

    public $customerphone_no, $customer_name, $doctor_consultation, $doctor_hospital;
    public $quantity, $batchid, $pharmproductid;
    public $items = [], $grandtotal = 0;
    public $product_id = [], $name = [], $expiry_date = [], $selling_price = [], $total = [], $amount = [],
    $schedule_drug = [], $pharmpurchaseentryitem = [], $batch = [];
    public $patient, $pharmacypatientlist, $highlightIndex, $ispatientselected = false,
    $patient_name, $customername, $patient_uhid;
    public $doctor, $pharmacydoctorlist, $dochighlightIndex, $isdoctorselected = false;

    public $prescription = false, $selectedprescription, $patient_id, $patientalreadyselected,
    $cgst, $sgst, $cgstamt, $sgstamt, $taxableamt, $taxamt;
    public $disc, $disc_amt, $taxable;

    protected $listeners = [
        'productselected', 'batchselected',
        'productdeselected' => 'productselected',
        'batchdeselected' => 'batchselected',
        'prescriptionselected',
    ];

    public function mount($prescriptionuuid = null)
    {
        if ($prescriptionuuid) {
            $this->prescription = true;
            $this->ispatientselected = true;
            $this->selectedprescription = Prescription::where('uuid', $prescriptionuuid)->first();
            $this->patient = $this->selectedprescription->patient->phone;
            $this->patient_name = $this->selectedprescription->patient->name;
            $this->patient_uhid = $this->selectedprescription->patient->uhid;
            $this->customername = $this->patient_name . '  ' . $this->patient_uhid;
            $this->patientalreadyselected = $prescriptionuuid;
            $this->doctor = $this->selectedprescription->doctor->name;
            $this->isdoctorselected = true;
        } else {
            $this->resetData();
            $this->docresetData();
        }
    }

    public function prescriptionselected($prescriptionid)
    {
        $this->prescription = true;
        $this->ispatientselected = true;
        $this->selectedprescription = Prescription::find($prescriptionid);
        $this->doctor = $this->selectedprescription->doctor->name;
        $this->isdoctorselected = true;
    }

    protected $rules = [
        'patient' => 'required',
    ];

    public function resetData()
    {
        $this->patient = '';
        $this->pharmacypatientlist = [];
        $this->highlightIndex = 0;
    }

    public function docresetData()
    {
        $this->doctor = '';
        $this->pharmacydoctorlist = [];
        $this->dochighlightIndex = 0;
    }

    public function docincrementHighlight()
    {
        if ($this->dochighlightIndex === count($this->pharmacydoctorlist) - 1) {
            $this->dochighlightIndex = 0;
            return;
        }
        $this->dochighlightIndex++;
    }

    public function docdecrementHighlight()
    {
        if ($this->dochighlightIndex === 0) {
            $this->dochighlightIndex = count($this->pharmacydoctorlist) - 1;
            return;
        }
        $this->dochighlightIndex--;
    }

    public function updatedDoctor()
    {
        $this->isdoctorselected = false;
        if ($this->doctor) {
            $this->pharmacydoctorlist = Doctor::where(function ($doctor) {
                $doctor->where('name', 'like', '%' . $this->doctor . '%');
            })
                ->get();
        } else {
            $this->docresetData();
        }
    }

    public function selectDoctor()
    {
        $doctor = $this->pharmacydoctorlist[$this->dochighlightIndex] ?? null;
        if ($doctor) {
            $higlightdoctor = $this->pharmacydoctorlist[$this->dochighlightIndex];
            $this->selecthisdoctor($higlightdoctor->id, $higlightdoctor->name);
        }
    }

    public function selecthisdoctor($id, $name)
    {
        $this->isdoctorselected = true;
        $this->doctor = $name;
        $this->dispatch('doctorselected', $id);
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->pharmacypatientlist) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->pharmacypatientlist) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function updatedPatient()
    {
        $this->ispatientselected = false;
        if ($this->patient) {
            $this->pharmacypatientlist = Patient::where(function ($patient) {
                $patient->where('phone', 'like', '%' . $this->patient . '%')
                    ->orWhere('name', 'like', '%' . $this->patient . '%')
                    ->orWhere('uhid', 'like', '%' . $this->patient . '%');
            })
                ->get();
        } else {
            $this->resetData();
        }
    }

    public function selectPatient()
    {
        $patient = $this->pharmacypatientlist[$this->highlightIndex] ?? null;
        if ($patient) {
            $higlightpatient = $this->pharmacypatientlist[$this->highlightIndex];
            $this->selecthispatient($higlightpatient->id, $higlightpatient->phone, $higlightpatient->uhid, $higlightpatient->name);
        }
    }

    public function selecthispatient($id, $phone, $uhid, $name)
    {
        $this->ispatientselected = true;
        $this->patient = $phone;
        $this->patient_name = $name;
        $this->patient_uhid = $uhid;
        $this->customername = $this->patient_name . '  ' . $this->patient_uhid;
        $this->patient_id = $id;
        $this->dispatch('patientselected');
    }

    public function productselected($productid)
    {
        $this->pharmproductid = $productid;
    }

    public function batchselected($batchid)
    {
        $this->batchid = $batchid;
    }

    public function addproduct()
    {
        $validate = $this->validate([
            'quantity' => 'required|numeric|min:1',
            'pharmproductid' => 'required',
            'batchid' => 'required',
        ], [
            'pharmproductid.required' => 'Required',
            'batchid.required' => 'Required',
            'quantity.min' => 'Invalid',
        ]);
        $productdetails = Pharmpurchaseentryitem::find($validate['batchid']);

        $key = array_search($productdetails->pharmacyproduct_id, $this->product_id);

        if (is_numeric($key)) {
            $count = 0;
            foreach ($this->batch as $batchkey => $value) {
                if ($this->batch[$batchkey] === $productdetails->batch) {
                    $this->amount[$batchkey] = $validate['quantity'] + $this->amount[$batchkey];
                    $this->total[$batchkey] = $productdetails->selling_price * $this->amount[$batchkey];
                    $count += 1;
                }
            }
            if ($count === 0) {
                $this->addprodutlogic($productdetails, $validate);
            }
        } else {
            $this->addprodutlogic($productdetails, $validate);
        }
        $this->quantity = null;
        $this->dispatch('cleanupfields');
    }

    protected function addprodutlogic($productdetails, $validate)
    {
        $total = $productdetails->selling_price * $validate['quantity'] +
            (($productdetails->pharmproduct->cgst / 100) * ($productdetails->selling_price * $validate['quantity'])) +
            (($productdetails->pharmproduct->sgst / 100) * ($productdetails->selling_price * $validate['quantity']));
        $this->items[] = [
            $this->product_id[] = $productdetails->pharmacyproduct_id,
            $this->pharmpurchaseentryitem[] = $productdetails->id,
            $this->batch[] = $productdetails->batch,
            $this->name[] = $productdetails->pharmproduct->name,
            $this->schedule_drug[] = $productdetails->pharmproduct->is_schedule ? true : false,
            $this->expiry_date[] = $productdetails->expiry_date,
            $this->selling_price[] = $productdetails->selling_price,
            $this->amount[] = $validate['quantity'],
            $this->cgst[] = $productdetails->pharmproduct->cgst,
            $this->sgst[] = $productdetails->pharmproduct->sgst,
            $this->cgstamt[] = ($productdetails->pharmproduct->cgst / 100) * ($productdetails->selling_price * $validate['quantity']),
            $this->sgstamt[] = ($productdetails->pharmproduct->sgst / 100) * ($productdetails->selling_price * $validate['quantity']),
            $this->disc[] = 0,
            $this->disc_amt[] = 0,
            $this->taxable[] = $total,
            $this->total[] = $total,
        ];
        $this->gloablcal();
    }

    public function removeitem($key)
    {
        unset($this->items[$key]);
        unset($this->product_id[$key]);
        unset($this->pharmpurchaseentryitem[$key]);
        unset($this->batch[$key]);
        unset($this->name[$key]);
        unset($this->expiry_date[$key]);
        unset($this->schedule_drug[$key]);
        unset($this->selling_price[$key]);
        unset($this->amount[$key]);
        unset($this->total[$key]);
        unset($this->disc[$key]);
        unset($this->taxable[$key]);
        unset($this->disc_amt[$key]);
        unset($this->cgst[$key]);
        unset($this->sgst[$key]);
        unset($this->cgstamt[$key]);
        unset($this->sgstamt[$key]);
        $this->gloablcal();
        $this->dispatch('cleanupfields');
    }

    public function productlivevalidation($key)
    {

        $total = ((is_numeric($this->amount[$key]) ? $this->amount[$key] : 0)
             * (is_numeric($this->selling_price[$key]) ? $this->selling_price[$key] : 0));

        $disc_amt = ((is_numeric($this->disc[$key]) ? $this->disc[$key] : 0) / 100) * $total;
        $taxable = $total - $disc_amt;

        $this->disc_amt[$key] = number_format((float) $disc_amt, 2, '.', '');
        $this->taxable[$key] = number_format((float) $taxable, 2, '.', '');
        $this->cgstamt[$key] = number_format((float) (($this->cgst[$key] / 100) * $taxable), 2, '.', '');
        $this->sgstamt[$key] = number_format((float) (($this->sgst[$key] / 100) * $taxable), 2, '.', '');
        $this->total[$key] = number_format((float) ($taxable + (($this->cgst[$key] / 100) * $taxable) + (($this->sgst[$key] / 100) * $taxable)), 2, '.', '');
        $this->gloablcal();
    }

    public function gloablcal()
    {
        $this->taxableamt = number_format((float) (collect($this->total)->sum() - (collect($this->cgstamt)->sum() + collect($this->sgstamt)->sum())), 2, '.', '');
        $this->taxamt = number_format((float) (collect($this->cgstamt)->sum() + collect($this->sgstamt)->sum()), 2, '.', '');
        $grandtotal = number_format((float) (collect($this->total)->sum()), 2, '.', '');

        $whole = floor($grandtotal);
        $fraction = $grandtotal - $whole;
        if ($fraction > 0.49) {
            $this->grandtotal = $whole + 1;
        } else {
            $this->grandtotal = $whole;
        }
    }

    public function savesalesentry()
    {
        $validatedData = $this->validate([
            'selling_price.*' => 'required|numeric|min:1',
            'amount.*' => 'required|numeric|min:1',
            'patient' => 'required|numeric|min:10',
            'patient_name' => 'required|string|min:3',
            'doctor' => 'required|string|min:3',
        ], [
            'selling_price.*.required' => 'Required',
            'selling_price.*.numeric' => 'Invalid',
            'selling_price.*.min' => 'Invalid',

            'amount.*.required' => 'Required',
            'amount.*.numeric' => 'Invalid',
            'amount.*.min' => 'Invalid',
        ]);
        $user = $this->currentuser();

        try {
            DB::beginTransaction();
            $patientdetail = Patient::where('phone', $this->patient)->first();
            if ($patientdetail) {
                $patientdetail->name = $this->patient_name;
                $patientdetail->save();
            } else {
                $patientdetail = $user->patientcreatable()->create([
                    'phone' => $this->patient,
                    'name' => $this->patient_name,
                    'active' => true,
                ]);
            }

            if ($this->doctor) {
                $doctordetail = Doctor::where('name', $this->doctor)->first();
                if (!$doctordetail) {
                    $doctordetail = $user->adddoctorcreatable()->create([
                        'name' => $this->doctor,
                        'created_source' => 'Pharmacy',
                        'active' => true,
                    ]);
                }
            }

            $whole = floor(collect($this->total)->sum());
            $fraction = collect($this->total)->sum() - $whole;
            if ($fraction > 0.49) {
                $data['round_off'] = 1 - $fraction;
                $data['grand_total'] = $whole + 1;
            } else {
                $data['round_off'] = $fraction;
                $data['grand_total'] = $whole;
            }

            $salesentry = $user->pharmsalesentrycreatable()->create([
                'patient_id' => $patientdetail->id,
                'doctor_id' => $doctordetail->id,
                'grand_total' => $data['grand_total'],
                'round_off' => $data['round_off'],
                'maintype' => $this->selectedprescription ? $this->selectedprescription->maintype : 'Walk-in',
                'subtype' => $this->selectedprescription ? $this->selectedprescription->subtype : 'Walk-in',
                'taxamt' => $this->taxamt,
                'disc_amt' => collect($this->disc_amt)->sum(),
                'taxableamt' => $this->taxableamt,
                'cgst' => collect($this->cgstamt)->sum(),
                'sgst' => collect($this->sgstamt)->sum(),
            ]);

            // Patient Statement
            $user->patientstatementcreatable()->make([
                'patient_id' => $patientdetail->id,
                'credit' => 0,
                'debit' => $data['grand_total'],
                'note' => 'Pharmacy Sales Entry',
                'entity_type' => 3,
                'transaction_type' => 'D',
                'statement_ref_id' => $salesentry->uniqid,
            ])
                ->statementable()
                ->associate($salesentry)
                ->save();

            // Hospital Statement
            $user->hospitalstatementcreatable()->make([
                'user_type' => 1,
                'credit' => 0,
                'debit' => $data['grand_total'],
                'note' => 'Pharmacy Sales Entry',
                'transaction_type' => 'D',
                'statement_ref_id' => $salesentry->uniqid,
            ])
                ->userable()
                ->associate($patientdetail)
                ->hstatementable()
                ->associate($salesentry)
                ->save();

            foreach ($this->items as $key => $value) {
                $product = Pharmacyproduct::find($this->product_id[$key]);
                $product->stock = $product->stock - $this->amount[$key];
                $product->save();

                $entryitem = Pharmpurchaseentryitem::find($this->pharmpurchaseentryitem[$key]);
                //Quantity Validation
                $this->withValidator(function (Validator $validator) use ($entryitem, $key) {
                    $validator->after(function ($validator) use ($entryitem, $key) {
                        if ($entryitem->quantity < $this->amount[$key]) {
                            $validator->errors()->add('amount.' . $key, 'Insufficient Quantity');
                        }
                    });
                })->validate();

                $entryitem->saled_quantity = $entryitem->saled_quantity + $this->amount[$key];
                $entryitem->quantity = $entryitem->quantity - $this->amount[$key];
                $entryitem->save();

                $pharmsalesentryitem = Pharmsalesentryitem::create([
                    'pharmacyproduct_id' => $product->id,
                    'pharmpurchaseentryitem_id' => $entryitem->id,
                    'batch' => $this->batch[$key],
                    'pharmsalesentry_id' => $salesentry->id,
                    'expiry_date' => $this->expiry_date[$key],
                    'quantity' => $this->amount[$key],
                    'selling_price' => number_format((float) $this->selling_price[$key], 2, '.', ''),
                    'is_schedule' => $this->schedule_drug[$key],
                    'cgst' => number_format((float) $this->cgst[$key], 2, '.', ''),
                    'cgstamt' => number_format((float) $this->cgstamt[$key], 2, '.', ''),
                    'sgst' => number_format((float) $this->sgst[$key], 2, '.', ''),
                    'sgstamt' => number_format((float) $this->sgstamt[$key], 2, '.', ''),
                    'disc' => number_format((float) $this->disc[$key], 2, '.', ''),
                    'disc_amt' => number_format((float) $this->disc_amt[$key], 2, '.', ''),
                    'taxable' => number_format((float) $this->taxable[$key], 2, '.', ''),
                    'total' => round($this->total[$key]),
                ]);

                Pharmproductinventory::create([
                    'pharmsalesentryitem_id' => $pharmsalesentryitem->id,
                    'pharmacyproduct_id' => $product->id,
                    'quantity' => $this->amount[$key],
                ]);
            }

            if ($this->selectedprescription) {
                $this->selectedprescription->ispharm_proccessed = true;
                $this->selectedprescription->save();
            }

            Helper::trackmessage($user, $salesentry, 'pharmacy_sales_entry', session()->getId(), 'WEB', 'Purchase Sales Created');
            DB::commit();
            $this->toaster('success', 'Purhcase Sales Created!!');
            $this->dispatch('printsalesentry', $salesentry->id);
            $this->formreset();
            return redirect()->route('pharmacy.pharmacyreceipt', $patientdetail->id);

        } catch (Exception $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_sales_entry', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_sales_entry', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->currentuser(), 'pharmacy_sales_entry', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->customerphone_no = $this->customer_name = $this->doctor_consultation = $this->doctor_hospital = null;
        $this->quantity = $this->batchid = $this->pharmproductid = null;
        $this->grandtotal = 0;
        $this->patient = $this->pharmacypatientlist = $this->highlightIndex = null;
        $this->patient_name = $this->customername = $this->patient_uhid = null;
        $this->doctor = $this->pharmacydoctorlist = $this->dochighlightIndex = null;
        $this->isdoctorselected = $this->prescription = $this->ispatientselected = false;
        $this->selectedprescription = $this->patient_id = $this->patientalreadyselected = null;
        $this->cgst = $this->sgst = $this->cgstamt = $this->sgstamt = $this->taxableamt = $this->taxamt = 0;

        $this->cgst = $this->sgst = $this->cgstamt = $this->sgstamt = $this->disc = $this->disc_amt =
        $this->taxable = $this->total = [];

        $this->items = $this->product_id = $this->name = $this->expiry_date = $this->selling_price =
        $this->total = $this->amount = $this->schedule_drug = $this->pharmpurchaseentryitem =
        $this->batch = $this->disc = $this->disc_amt = $this->taxable = [];
    }

    public function render()
    {
        return view('livewire.pharmacy.sales.salesentry.salesentrycreatelivewire');
    }
}
