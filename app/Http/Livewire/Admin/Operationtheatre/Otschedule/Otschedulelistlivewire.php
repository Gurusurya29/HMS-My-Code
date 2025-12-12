<?php

namespace App\Http\Livewire\Admin\Operationtheatre\Otschedule;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Operationtheatre\Otschedule\Otschedule;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Hash;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Otschedulelistlivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;

    public $password, $is_movetoip, $movetoip_note;

    public $otschedule_id;
    public $showdata;
    public $from_date;
    public $to_date;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'is_movetoip' => 'required',
            'movetoip_note' => 'required|max:255',
            'password' => 'required|min:8',
        ];
    }

    protected function messages()
    {
        return [
            'is_movetoip.required' => 'Please Confirm the checkbox',
            'movetoip_note.required' => 'Note field is required',
            'movetoip_note.max' => 'Note must not be greater than 255 characters',
        ];
    }

    public function mount()
    {
        $this->from_date = null;
        $this->to_date = null;
    }

    public function storemovetoip()
    {
        $validatedData = $this->validate();
        $user = auth()->user();
        try {
            DB::beginTransaction();
            if (Hash::check($this->password, $user->password)) {
                $validatedData['is_movetoip'] = Carbon::now();
                $otschedule = Otschedule::find($this->otschedule_id);
                $otschedule->update($validatedData);
                $user->otscheduleupdatable()->save($otschedule);
                $otschedule->inpatient->update(['is_movedto_ot' => false]);
                $bedorroomnumber = Bedorroomnumber::find($otschedule->bedorroomnumber_id);
                $bedorroomnumber->update([
                    'is_available' => 2,
                    'bedoccupiable_id' => null,
                    'bedoccupiable_type' => null,
                ]);
                Helper::trackmessage($user, $otschedule, 'otschedule_createoredit', session()->getId(), 'WEB', 'OT patient movement confirmation');
                $this->toaster('success', 'OT Patient Movement Confirmed Successfully!!');

            } else {
                $this->toaster('error', 'Oops, Invalid Password!!');
            }
            DB::commit();
            $this->formreset();
            $this->dispatch('movetoipclosemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_otschedule_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_otschedule_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_otschedule_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->is_movetoip = $this->movetoip_note = $this->otschedule_id = null;
        $this->resetValidation();
    }

    protected function databind($otscheduleid, $type)
    {
        $this->showdata = Otschedule::find($otscheduleid);
    }

    public function downloadFile($otscheduleuniqid, $file_name)
    {
        $file = storage_path('app/public/admin/otschedule/' . $otscheduleuniqid . '/' . $file_name);
        $this->dispatch('closeshowmodal');
        return response()->download($file);
    }

    public function movetoip($otscheduleid)
    {
        $this->otschedule_id = $otscheduleid;
        $this->dispatch('movetoip');
    }

    public function render()
    {
        $from_date = $this->from_date;
        $to_date = $this->to_date;
        $otschedulelist = Otschedule::with('patient')->where('active', true)
            ->where('is_otactive', true)
            ->whereNull('is_movetoip')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('surgery_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('patient', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('uhid', 'like', '%' . $this->searchTerm . '%')
                    )
                    ->orWhereHas('doctor', fn(Builder $q) =>
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                    )
            )
            ->when($from_date, function ($query, $from_date) {
                $query->whereDate('surgery_startdate', '>=', $from_date);
            })
            ->when($to_date, function ($query, $to_date) {
                $query->whereDate('surgery_startdate', '<=', $to_date);
            })
            ->latest()
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.operationtheatre.otschedule.otschedulelistlivewire',
            compact('otschedulelist'));
    }
}
