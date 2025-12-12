<?php

namespace App\Http\Livewire\Admin\Settings\Ipsetting\Iptreatment;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Ipsetting\Iptreatment;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Iptreatmentlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $name, $note, $active = false;

    public $iptreatment_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required|unique:iptreatments,name,' . $this->iptreatment_id,
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
            if ($this->iptreatment_id) {
                $iptreatment = Iptreatment::find($this->iptreatment_id);
                $iptreatment->update($validatedData);
                $user->iptreatmentupdatable()->save($iptreatment);
                Helper::trackmessage($user, $iptreatment, 'iptreatment_createoredit', session()->getId(), 'WEB', 'IP Treatment Updated');
                $this->toaster('success', 'IP Treatment Updated Successfully!!');
            } else {
                $iptreatment = $user->iptreatmentcreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $iptreatment, 'iptreatment_createoredit', session()->getId(), 'WEB', 'IP Treatment Created');
                $this->toaster('success', 'IP Treatment Created Successfully!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_iptreatments_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_iptreatments_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_iptreatments_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    protected function databind($iptreatmentid, $type)
    {
        if ($type == 'edit') {
            $iptreatment = Iptreatment::find($iptreatmentid);
            $this->name = $iptreatment->name;
            $this->note = $iptreatment->note;
            $this->active = $iptreatment->active;
            $this->iptreatment_id = $iptreatmentid;
        } else {
            $this->showdata = Iptreatment::find($iptreatmentid);
        }
    }

    public function formreset()
    {
        $this->name = $this->note = $this->iptreatment_id = null;
        $this->active = false;
        $this->resetValidation();
    }

    public function render()
    {
        $iptreatment = Iptreatment::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);
        return view('livewire.admin.settings.ipsetting.iptreatment.iptreatmentlivewire',
            compact('iptreatment'));
    }
}
