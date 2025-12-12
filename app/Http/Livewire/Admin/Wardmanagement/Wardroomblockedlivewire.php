<?php

namespace App\Http\Livewire\Admin\Wardmanagement;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Settings\Wardsetting\Bedorroomnumber;
use App\Models\Admin\Settings\Wardsetting\Wardtype;
use App\Models\Admin\Wardmanagement\Bedorroom\Blockbedorroomhistory;
use App\Models\Miscellaneous\Helper;
use Hash;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Wardroomblockedlivewire extends Component
{
    use miscellaneousLivewireTrait, datatableLivewireTrait;

    public $wardtype, $bedorroom;
    public $blockroomid, $unblockroomid;
    public $password, $note;

    protected $rules = [
        'password' => 'required|min:8',
        'note' => 'nullable|max:255',
    ];

    public function blockroomdata($id)
    {
        $this->blockroomid = $id;
    }

    public function saveblockbedorroom()
    {
        try {

            $validatedData = $this->validate();
            $user = auth()->user();
            DB::beginTransaction();
            $bedorroom = Bedorroomnumber::find($this->blockroomid);

            if (Hash::check($this->password, $user->password)) {
                if ($bedorroom->is_available == 3) {
                    $bedorroom->update(['is_available' => 0]);
                    $validatedData['bedorroomnumber_id'] = $bedorroom->id;
                    $validatedData['roomnumber'] = $bedorroom->name;
                    $validatedData['type'] = 'UN BLOCK';

                    Helper::trackmessage($user, $bedorroom, 'saveblockbedorroom_block', session()->getId(), 'WEB', 'Block Bed or Room');
                    $this->toaster('success', 'Room Un Block Done Successfully!!');

                } else {
                    $bedorroom->update(['is_available' => 3]);
                    $validatedData['bedorroomnumber_id'] = $bedorroom->id;
                    $validatedData['roomnumber'] = $bedorroom->name;
                    $validatedData['type'] = 'BLOCK';
                    Helper::trackmessage($user, $bedorroom, 'saveblockbedorroom_unblock', session()->getId(), 'WEB', 'Un Block Bed or Room');
                    $this->toaster('success', 'Room Block Done Successfully!!');
                }

                $user->blockbedorroomhistorycreatable()
                    ->create($validatedData);
            } else {
                $this->toaster('error', 'Oops, Invalid Password!!');
            }

            $this->dispatch('wardroomblockedmodalclose');

            DB::commit();
            $this->formreset();

        } catch (Exception $e) {
            $this->exceptionerror($user, 'admin_saveblockbedorroom_blockorunblock', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'admin_saveblockbedorroom_blockorunblock', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'admin_saveblockbedorroom_blockorunblock', 'error_three : ' . $e->getMessage());
        }
    }

    public function formreset()
    {
        $this->password = $this->note = $this->blockroomid = $this->unblockroomid = null;
        $this->resetValidation();
    }

    public function render()
    {

        $blockbedorroomhistory = Blockbedorroomhistory::query()
            ->where(fn($q) =>
                $q->where('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('roomnumber', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('type', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('note', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        $this->wardtype = Wardtype::where('active', true)->get();
        $this->bedorroom = Bedorroomnumber::where('active', true)
            ->whereIn('is_available', [0, 3])
            ->get();

        return view('livewire.admin.wardmanagement.wardroomblockedlivewire',
            compact('blockbedorroomhistory'));
    }
}
