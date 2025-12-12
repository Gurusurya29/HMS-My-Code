<?php

namespace App\Http\Livewire\Pharmacy\Settings\Branch\Pharmacybranch;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Pharmacy\Settings\Branch\Pharmbranch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pharmacybranchlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $contact_person, $branch_name, $gstin, $pan, $note;

    public $pharmbranch_id;
    public $showdata;

    protected $listeners = ['formreset'];

    public function mount()
    {
        $this->user = $this->currentuser();
    }

    protected function rules()
    {
        return [
            'branch_name' => 'required|min:2|max:70',
            'note' => 'nullable|max:255',
            'contact_person' => 'required',
            'gstin' => 'nullable|size:15',
            'pan' => 'nullable|size:10',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();

        try {
            DB::beginTransaction();

            $pharmbranch = Pharmbranch::find($this->pharmbranch_id);
            $pharmbranch->update($validatedData);
            $this->user->pharmbranchupdatable()->save($pharmbranch);

            Helper::trackmessage($this->user, $pharmbranch, 'pharmbranch_edit', session()->getId(), 'WEB', 'Pharmacy Branch Updated');
            $this->toaster('success', 'Branch Updated Successfully!!');

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($this->user, 'pharmacy_branch_edit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($this->user, 'pharmacy_branch_edit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($this->user, 'pharmacy_branch_edit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($pharmbranchid, $type)
    {
        if ($type == 'edit') {
            $pharmbranch = Pharmbranch::find($pharmbranchid);
            $this->pharmbranch_id = $pharmbranchid;
            $this->contact_person = $pharmbranch->contact_person;
            $this->branch_name = $pharmbranch->branch_name;
            $this->gstin = $pharmbranch->gstin;
            $this->pan = $pharmbranch->pan;
            $this->note = $pharmbranch->note;
        } else {
            $this->showdata = Pharmbranch::find($pharmbranchid);
        }
    }

    public function formreset()
    {
        $this->branch_name = $this->note = $this->pharmbranch_id = null;
        $this->resetValidation();
    }

    public function render()
    {
        $pharmbranch = Pharmbranch::query()
            ->where(function ($query) {
                $query->where('branch_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.pharmacy.settings.branch.pharmacybranch.pharmacybranchlivewire',
            compact('pharmbranch'));
    }
}
