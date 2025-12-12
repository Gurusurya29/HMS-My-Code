<?php

namespace App\Http\Livewire\Admin\Settings\Ipsetting\Ipservicecategory;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Ipsetting\Ipservicecategory;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Ipservicecategorylivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $ipservicecategory_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:ipservicecategories,name,' . $this->ipservicecategory_id,
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
            if ($this->ipservicecategory_id) {
                $ipservicecategory = Ipservicecategory::find($this->ipservicecategory_id);
                $ipservicecategory->update($validatedData);
                $user->ipservicecategoryupdatable()->save($ipservicecategory);
                Helper::trackmessage($user, $ipservicecategory, 'ipservicecategory_createoredit', session()->getId(), 'WEB', 'IP Service Category Updated');
                $this->toaster('success', 'IP Service Category Updated Successfully!!');
            } else {
                $ipservicecategory = $user->ipservicecategorycreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $ipservicecategory, 'ipservicecategory_createoredit', session()->getId(), 'WEB', 'IP Service Category Created');
                $this->toaster('success', 'IP Service Category Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_ipservicecategorys_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_ipservicecategorys_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_ipservicecategorys_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($ipservicecategoryid, $type)
    {
        if ($type == 'edit') {
            $ipservicecategory = Ipservicecategory::find($ipservicecategoryid);
            $this->name = $ipservicecategory->name;
            $this->note = $ipservicecategory->note;
            $this->active = $ipservicecategory->active;
            $this->ipservicecategory_id = $ipservicecategoryid;
        } else {
            $this->showdata = Ipservicecategory::find($ipservicecategoryid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->ipservicecategory_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $ipservicecategory = Ipservicecategory::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.ipsetting.ipservicecategory.ipservicecategorylivewire',
            compact('ipservicecategory'));
    }
}
