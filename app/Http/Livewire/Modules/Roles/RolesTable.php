<?php

namespace App\Http\Livewire\Modules\Roles;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class RolesTable extends Component
{
    use WithPagination;

    public $headers = ['S/N','Name','Users','Date Created','Action'];
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function DeleteRole(int $id)
    {
        if (DB::table('roles')->where('id', $id)->delete()){
            $this->emitSelf('success','Role deleted successfully');
        }else{
            $this->emitSelf('error','Role not found');
        }
    }


    public function render()
    {
        return view('livewire.modules.roles.roles-table', [
            'roles' => DB::table('roles')->search(['name','title'], $this->searchTerm)
            ->select('id','name','title','created_at')
            ->paginate(10)
        ]);
    }
}
