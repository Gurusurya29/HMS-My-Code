<?php

namespace App\Http\Livewire\Admin\Employee\Addemployee;

use App\Http\Livewire\Livewirehelper\Datatable\datatableLivewireTrait;
use App\Http\Livewire\Livewirehelper\Miscellaneous\miscellaneousLivewireTrait;
use App\Models\Admin\Employee\Employee;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Addemployeelivewire extends Component
{
    use datatableLivewireTrait, miscellaneousLivewireTrait;
    use WithFileUploads;

    public $name, $phone, $email, $password, $password_confirmation, $note, $is_accountactive = false;
    public $avatar = null, $existingavatar;
    public $employee_id;
    public $showdata;

    protected $listeners = ['formreset'];

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => 'nullable|email|unique:employees,email,' . $this->employee_id,
            'phone' => 'required|digits:10|numeric|unique:employees,phone,' . $this->employee_id,
            'avatar' => 'nullable|image|max:1024',

            'dob' => 'nullable|date',
            'doj' => 'nullable|date',
            'education_qualification' => 'nullable|max:75',
            'previous_organisation' => 'nullable|max:75',
            'experience' => 'nullable|max:75',
            'aadhar_no' => 'nullable|max:75',
            'pan_no' => 'nullable|max:75',
            'bank_name' => 'nullable|max:75',
            'bank_account_no' => 'nullable|max:75',
            'bank_ifsc_code' => 'nullable|max:75',
            'bank_branch' => 'nullable|max:75',

            'note' => 'nullable|max:255',
            'is_accountactive' => 'nullable|boolean',
        ];
    }

    protected function customvalidation()
    {
        $validatedData = $this->validate();

        // if (!$this->employee_id) {
        //     $validatedData = array_merge($validatedData,
        //         $this->validate(['password' => 'required|string|min:2|confirmed']));
        // }
        return $validatedData;
    }

    public function store()
    {

        $validatedData = $this->customvalidation();
        $user = auth()->user();

        try {
            DB::beginTransaction();

            if ($this->employee_id) {
                $employee = Employee::find($this->employee_id);
                $employee->update($validatedData);
                $user->employeeupdatable()->save($employee);
                Helper::trackmessage($user, $employee, 'employee_employee_createoredit', session()->getId(), 'WEB', 'Employee Updated');
                $this->toaster('success', 'Employee Updated Successfully!!');
            } else {
                $validatedData['password'] = $validatedData['phone'];
                $employee = $user->employeecreatable()
                    ->create($validatedData);
                Helper::trackmessage($user, $employee, 'employee_employee_createoredit', session()->getId(), 'WEB', 'Employee Created');
                $this->toaster('success', 'Employee Created Successfully!!');
            }

            if ($validatedData['avatar']) {
                ($employee->avatar) ? Storage::delete('public/' . $employee->avatar) : '';
                $saveimage = Image::make($validatedData['avatar'])
                    ->resize(150, 150)
                    ->encode('jpg', 90)
                    ->stream();

                $employee->avatar = $path = 'employee/image/userprofile/' . time() . '.jpg';
                Storage::disk('public')->put($path, $saveimage, 'public');
                $employee->save();
            }

            DB::commit();
            $this->formreset();
            $this->dispatch('closemodal');
        } catch (Exception $e) {
            $this->exceptionerror($user, 'employee_employee_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror($user, 'employee_employee_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror($user, 'employee_employee_createoredit', 'error_three : ' . $e->getMessage());
        }
    }

    public function edit($employee_id)
    {
        $this->formreset();
        $this->databind($employee_id, 'edit');
        $this->dispatch('editmodal');
    }

    public function show($employee_id)
    {
        $this->databind($employee_id, 'show');
        $this->dispatch('showmodal');
    }

    protected function databind($employee_id, $type)
    {

        if ($type == 'edit') {
            $employee = Employee::find($employee_id);
            $this->employee_id = $employee_id;
            $this->name = $employee->name;
            $this->phone = $employee->phone;
            $this->email = $employee->email;
            $this->existingavatar = $employee->avatar;
            $this->dob = $employee->dob;
            $this->doj = $employee->doj;
            $this->education_qualification = $employee->education_qualification;
            $this->previous_organisation = $employee->previous_organisation;
            $this->experience = $employee->experience;
            $this->aadhar_no = $employee->aadhar_no;
            $this->pan_no = $employee->pan_no;
            $this->bank_name = $employee->bank_name;
            $this->bank_account_no = $employee->bank_account_no;
            $this->bank_ifsc_code = $employee->bank_ifsc_code;
            $this->bank_branch = $employee->bank_branch;
            $this->note = $employee->note;
            $this->is_accountactive = $employee->is_accountactive;
        } else {
            $this->showdata = Employee::find($employee_id);
        }
    }

    public function formreset()
    {
        $this->name = $this->phone = $this->email =
        $this->avatar =
        $this->existingavatar = $this->password = $this->password_confirmation =
        $this->note = $this->employee_id =
        $this->dob = $this->doj = $this->education_qualification =
        $this->previous_organisation = $this->experience =
        $this->aadhar_no = $this->pan_no = $this->bank_name =
        $this->bank_account_no = $this->bank_ifsc_code =
        $this->bank_branch = null;

        $this->is_accountactive = false;
        $this->resetValidation();
    }

    public function render()
    {
        $employee = Employee::query()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('uniqid', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)
            ->onEachSide(1);

        return view('livewire.admin.employee.addemployee.addemployeelivewire', compact('employee'));
    }
}
