<?php

namespace App\Http\Livewire\Admin\Settings\Ipsetting\Ipservicemaster;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Ipsetting\Ipservicecategory;
use App\Models\Admin\Settings\Ipsetting\Ipservicemaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipservicemasterlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $ipservicecategory_id, $insurancefee, $selffee, $is_package, $is_otservice, $note;
    public $ipservicecategory_list = [];
    public $ipservicemaster_id, $active = false;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:ipservicemasters,name,' . $this->ipservicemaster_id,
            'ipservicecategory_id' => 'required|numeric',
            'insurancefee' => 'required|numeric|integer',
            'selffee' => 'required|numeric|integer',
            'is_package' => 'nullable|boolean',
            'is_otservice' => 'nullable|boolean',
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

    public function mount()
    {
        $this->ipservicecategory_list = Ipservicecategory::where('active', true)->pluck('name', 'id');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if ($this->ipservicemaster_id) {
                $ipservicemaster = Ipservicemaster::find($this->ipservicemaster_id);
                $ipservicemaster->update($validatedData);
                $user->ipservicemasterupdatable()->save($ipservicemaster);
                Helper::trackmessage($user, $ipservicemaster, 'ipservicemaster_createoredit', session()->getId(), 'WEB', 'IP Service Master Updated');
                $this->toaster('success', 'IP Service Master Updated Successfully!!');
            } else {
                $ipservicemaster = $user->ipservicemastercreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $ipservicemaster, 'ipservicemaster_createoredit', session()->getId(), 'WEB', 'IP Service Master Created');
                $this->toaster('success', 'IP Service Master Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_ipservicemasters_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_ipservicemasters_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_ipservicemasters_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($ipservicemasterid, $type)
    {
        if ($type == 'edit') {
            $ipservicemaster = Ipservicemaster::find($ipservicemasterid);
            $this->name = $ipservicemaster->name;
            $this->ipservicecategory_id = $ipservicemaster->ipservicecategory_id;
            $this->insurancefee = $ipservicemaster->insurancefee;
            $this->selffee = $ipservicemaster->selffee;
            $this->note = $ipservicemaster->note;
            $this->active = $ipservicemaster->active;
            $this->is_package = $ipservicemaster->is_package;
            $this->is_otservice = $ipservicemaster->is_otservice;
            $this->ipservicemaster_id = $ipservicemasterid;
        } else {
            $this->showdata = Ipservicemaster::find($ipservicemasterid);
        }
    }

    public function formreset()
    {
        $this->name = $this->insurancefee = $this->selffee = $this->note = $this->ipservicecategory_id = $this->ipservicemaster_id = null;
        $this->is_package = $this->is_otservice = $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $ipservicemaster = Ipservicemaster::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.ipsetting.ipservicemaster.ipservicemasterlivewire',
            compact('ipservicemaster'));
    }
}
