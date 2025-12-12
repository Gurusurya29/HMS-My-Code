<?php

namespace App\Http\Livewire\Admin\Inpatient\Ipnursingstation\Ippatienttransfer;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Inpatient\Inpatient;
use App\Models\Admin\Inpatient\Ippatienttransfer;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ippatienttransferlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $inpatient, $user, $wardtype_data = [], $bedorroomnumber_data = [];
    public $showdata;
    public $changedwardtype_id, $changedroom_id, $changedroom_name, $note;

    protected $rules = [
        'changedwardtype_id' => 'required',
        'changedroom_id' => 'required',
        'note' => 'required|max:255',
    ];

    public function mount($inpatient_uuid)
    {
        $this->inpatient = Inpatient::where('uuid', $inpatient_uuid)->first();
        $this->wardtype_data = Wardtype::where('active', true)->where('ward_category', 1)->pluck('name', 'id');
        $this->user = auth()->user();
    }

    public function Updatedchangedwardtypeid()
    {
        $this->bedorroomnumber_data = Bedorroomnumber::where('active', true)
            ->where('is_available', 0)
            ->where('wardtype_id', $this->changedwardtype_id)
            ->whereNotIn('id', [$this->inpatient->ipadmission->bedorroomnumber->id])
            ->pluck('name', 'id');
    }

    public function store()
    {
        $validatedData = $this->validate();
        try {
            DB::beginTransaction();
            $validatedData['patient_id'] = $this->inpatient->patient_id;
            $validatedData['inpatient_id'] = $this->inpatient->id;
            $validatedData['ipadmission_id'] = $this->inpatient->ipadmission->id;
            $validatedData['previousroom_id'] = $this->inpatient->ipadmission->bedorroomnumber->id;
            $validatedData['previousroom_name'] = $this->inpatient->ipadmission->wardtype->name . '-' . $this->inpatient->ipadmission->bedorroomnumber->name;
            $changedroom = Bedorroomnumber::where('id', $validatedData['changedroom_id'])->first();
            $validatedData['changedroom_name'] = $changedroom->wardtype->name . '-' . $changedroom->name;

            $ippatienttransfer = $this->user->ippatienttransfercreatable()
                ->create($validatedData);
            $this->inpatient->ipadmission->update([
                'wardtype_id' => $validatedData['changedwardtype_id'],
                'bedorroomnumber_id' => $validatedData['changedroom_id'],
            ]);
            $changedroom->update([
                'is_available' => 1,
            ]);
            $this->inpatient->ipadmission->bedoccupiable()->save($changedroom);
            $bedorroomnumber = Bedorroomnumber::find($validatedData['previousroom_id']);
            $bedorroomnumber->update([
                'is_available' => 2,
                'bedoccupiable_id' => null,
                'bedoccupiable_type' => null,
            ]);
            Helper::trackmessage($this->user, $ippatienttransfer, 'ippatienttransfer_createoredit', session()->getId(), 'WEB', 'IP Patient transfered successfully');
            DB::commit();
            $this->toaster('success', 'Patient transferd Successfully!!');
            return redirect()->route('ippatienttransfer', $this->inpatient->uuid);
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'admin_ippatienttransfer_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'admin_ippatienttransfer_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'admin_ippatienttransfer_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($ippatienttransferid, $type)
    {
        if ($type == 'edit') {
            $ippatienttransfer = Ippatienttransfer::find($ippatienttransferid);
            $this->note = $ippatienttransfer->note;
        } else {
            $this->showdata = Ippatienttransfer::find($ippatienttransferid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->ippatienttransfer_id = null;
        $this->resetValidation();
    }

    public function render()
    {
        $ippatienttransferlist = Ippatienttransfer::where('active', true)
            ->where('inpatient_id', $this->inpatient->id)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.inpatient.ipnursingstation.ippatienttransfer.ippatienttransferlivewire', compact('ippatienttransferlist'));
    }
}
