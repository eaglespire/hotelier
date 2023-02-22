<?php

namespace App\Http\Livewire\Modules\Users;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UsersTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','User','Email','Date Created','Status','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
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
        return view('livewire.modules.users.users-table',
            [
                'users' => User::search(['firstname','lastname','status','email'], $this->searchTerm)
                            ->where('id','>',1)
                            ->latest()
                            ->select('firstname','lastname','email','status','id','slug','created_at')
                            ->simplePaginate(10)
            ]
        );

    }
}
