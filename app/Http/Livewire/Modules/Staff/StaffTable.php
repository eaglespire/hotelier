<?php

namespace App\Http\Livewire\Modules\Staff;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StaffTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Avatar', 'Name','Gender','Staff ID','Date Joined','Role','Action'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function SuspendStaff(int $id)
    {
        $staff = Employee::find($id);
        $staff->user()->update([
           'status' => false
        ]);
        $this->emit('success','Action was successful');
    }
    public function UnbanStaff(int $id)
    {
        $staff = Employee::find($id);
        $staff->user()->update([
            'status' => true
        ]);
        $this->emit('success','Action was successful');
    }

    public function DeleteStaff(int $id)
    {
        if (DB::table('employees')->where('id', $id)->delete()){
            $this->emitSelf('success','Staff deleted successfully');
        }else{
            $this->emitSelf('error','Staff not found');
        }
    }

    public function render()
    {
        return view('livewire.modules.staff.staff-table', [
            'users' => Employee::with(['user'])
                        ->search(['gender','staff_number','city'], $this->searchTerm)
                        ->simplePaginate(10)
        ]);
    }
}
