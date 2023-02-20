<?php

namespace App\Http\Livewire\Modules\Users;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UsersTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }
    public function export()
    {
        sleep(1);
        return Excel::download(new UsersExport,'users.xlsx');
    }

    public function deleteUser(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $this->emitSelf('success','User removed successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','User not found');
        }
        return back();
    }

    public function render()
    {
        //sleep(1);
        return view('livewire.modules.users.users-table', [
            'users' =>
                User::search(['firstname','lastname','email'], $this->searchTerm)
                ->latest()
                ->select('firstname','lastname','email','created_at','id','slug')
                ->paginate(10)
        ]);
    }
}
