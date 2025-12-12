<?php

namespace App\Http\Livewire\Admin\Wardmanagement;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Admin\Wardmanagement\Housekeeping\Housekeepinghistory;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Wardhousekeepinglivewire extends Component
{
    use miscellaneousLivewireTrait, datatableLivewireTrait;

    public $wardtype, $bedorroom;
    public $housekeepingid;
    public $password, $note;
    public $modaltitle;

    protected $rules = [
        'password' => 'required|min:8',
        'note' => 'nullable|max:255',
    ];

    public function housekeepingdata($id, $modaltitle)
    {
        $this->housekeepingid = $id;
        $this->modaltitle = $modaltitle;

    }

    public function savehousekeeping()
{
    $this->validate(); // 👈 This ensures validation runs only when Save is clicked

    try {
        $user = auth()->user();
        DB::beginTransaction();

        $bedorroom = Bedorroomnumber::find($this->housekeepingid);

        if (Hash::check($this->password, $user->password)) {

            if ($bedorroom->is_available == 0) {
                $bedorroom->update(['is_available' => 2]);
                Helper::trackmessage($user, $bedorroom, 'savehousekeeping', session()->getId(), 'WEB', 'Move to House Keeping');
                $this->toaster('success', 'Move to House Keeping Done Successfully!!');

            } elseif ($bedorroom->is_available == 2) {
                $bedorroom->update(['is_available' => 0]);
                $this->toaster('success', 'House Keeping Done Successfully!!');

                $user->housekeepinghistorycreatable()->create([
                    'bedorroomnumber_id' => $bedorroom->id,
                    'roomnumber' => $bedorroom->name,
                    'cleaned_by' => $user->name,
                    'note' => $this->note,
                ]);
            } else {
                $this->toaster('error', 'Oops, Something Went Wrong!!');
            }

        } else {
            $this->toaster('error', 'Oops, Invalid Password!!');
        }

        $this->dispatch('bedorroomnumbermodalclose');

        DB::commit();
        $this->formreset();

    } catch (Exception|QueryException|PDOException $e) {
        $this->exceptionerror($user, 'admin_savehousekeeping', $e->getMessage());
    }
}

    // public function savehousekeeping()
    // {
    //     try {

    //         $validatedData = $this->validate();
    //         $user = auth()->user();
    //         DB::beginTransaction();
    //         $bedorroom = Bedorroomnumber::find($this->housekeepingid);

    //         if (Hash::check($this->password, $user->password)) {

    //             if ($bedorroom->is_available == 0) {
    //                 $bedorroom->update(['is_available' => 2]);
    //                 Helper::trackmessage($user, $bedorroom, 'savehousekeeping', session()->getId(), 'WEB', 'Move to House Keeping');
    //                 $this->toaster('success', 'Move to House Keeping Done Successfully!!');

    //             } elseif ($bedorroom->is_available == 2) {
    //                 $bedorroom->update(['is_available' => 0]);
    //                 $validatedData['bedorroomnumber_id'] = $bedorroom->id;
    //                 $validatedData['roomnumber'] = $bedorroom->name;
    //                 $validatedData['cleaned_by'] = $user->name;

    //                 Helper::trackmessage($user, $bedorroom, 'savehousekeeping', session()->getId(), 'WEB', 'Save House Keeping');
    //                 $this->toaster('success', 'House Keeping Done Successfully!!');

    //                 $user->housekeepinghistorycreatable()
    //                     ->create($validatedData);
    //             } else {
    //                 $this->toaster('error', 'Oops, Something Went to Wrong!!');
    //             }

    //         } else {
    //             $this->toaster('error', 'Oops, Invalid Password!!');
    //         }

    //         $this->dispatch('bedorroomnumbermodalclose');

    //         DB::commit();
    //         $this->formreset();

    //     } catch (Exception $e) {
    //         $this->exceptionerror($user, 'admin_savehousekeeping', 'error_one : ' . $e->getMessage());
    //     } catch (QueryException $e) {
    //         $this->exceptionerror($user, 'admin_savehousekeeping', 'error_two : ' . $e->getMessage());
    //     } catch (PDOException $e) {
    //         $this->exceptionerror($user, 'admin_savehousekeeping', 'error_three : ' . $e->getMessage());
    //     }
    // }

    public function formreset()
    {
        $this->password = $this->note = $this->housekeepingid = null;
        $this->resetValidation();
    }

    public function render()
    {

        $housekeepinghistory = Housekeepinghistory::query()
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('roomnumber', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('note', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $this->wardtype = Wardtype::where('active', true)->get();
        $this->bedorroom = Bedorroomnumber::where('active', true)
            ->whereIn('is_available', [0, 2])
            ->get();

        return view('livewire.admin.wardmanagement.wardhousekeepinglivewire',
            compact('housekeepinghistory'));
    }
}
