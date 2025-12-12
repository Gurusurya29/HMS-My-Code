<?php

namespace App\Http\Livewire\Admin\Settings\Opsetting\Opservicemaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Opsetting\Opservicemaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Opservicemasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $insurancefee, $selffee, $is_package = false, $note, $active = false;

    public $opservicemaster_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:opservicemasters,name,' . $this->opservicemaster_id,
            'insurancefee' => 'required|numeric|integer',
            'selffee' => 'required|numeric|integer',
            'is_package' => 'nullable|boolean',
            'note' => 'nullable|max:255',
            'active' => 'nullable|boolean',
        ];
    }
    protected function messages()
    {
        return [
            'insurancefee.integer' => 'Enter valid value.',
            'selffee.integer' => 'Enter valid value.',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->opservicemaster_id) {
                $opservicemaster = Opservicemaster::find($this->opservicemaster_id);
                $opservicemaster->update($validatedData);
                $user->opservicemasterupdatable()->save($opservicemaster);
                Helper::trackmessage($user, $opservicemaster, 'opservicemaster_createoredit', session()->getId(), 'WEB', 'OP Service Setting Updated');
                $this->toaster('success', 'OP Service Setting Updated Successfully!!');
            } else {
                $opservicemaster = $user->opservicemastercreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $opservicemaster, 'opservicemaster_createoredit', session()->getId(), 'WEB', 'OP Service Setting Created');
                $this->toaster('success', 'OP Service Setting Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_opservicemasters_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_opservicemasters_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_opservicemasters_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($opservicemasterid, $type)
    {
        if ($type == 'edit') {
            $opservicemaster = Opservicemaster::find($opservicemasterid);
            $this->name = $opservicemaster->name;
            $this->note = $opservicemaster->note;
            $this->insurancefee = $opservicemaster->insurancefee;
            $this->selffee = $opservicemaster->selffee;
            $this->is_package = $opservicemaster->is_package;
            $this->active = $opservicemaster->active;
            $this->opservicemaster_id = $opservicemasterid;
        } else {
            $this->showdata = Opservicemaster::find($opservicemasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->insurancefee = $this->selffee = $this->note = $this->opservicemaster_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $opservicemaster = Opservicemaster::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.opsetting.opservicemaster.opservicemasterlivewire',
            compact('opservicemaster'));
    }
}
