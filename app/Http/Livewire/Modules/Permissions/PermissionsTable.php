<?php

namespace App\Http\Livewire\Modules\Permissions;

use App\Exports\UsersExport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PermissionsTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';

    public $headers = ['S/N','name','title','entities'];

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

    public function render()
    {
        return view('livewire.modules.permissions.permissions-table', [
            'permissions' => DB::table('abilities')->search(['name'],$this->searchTerm)->paginate(10)
        ]);
    }
}
