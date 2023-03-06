<?php

namespace App\Http\Livewire\Modules\Files;

use App\Models\FileManager;
use Livewire\Component;
use Livewire\WithPagination;

class Folder extends Component
{
    public $folder;
    protected $paginationTheme = 'bootstrap';
    public function mount($folder)
    {
        $this->folder = $folder;
    }
    public function delete(int $id)
    {
        FileManager::where('id',$id)->delete();
        $this->emitSelf('success','Deleted successfully');
        //return redirect()->header('referrer');
        return redirect(request()->header('referer'));
    }
    public function render()
    {
        return view('livewire.modules.files.folder', [
            'files' => FileManager::where('folder',$this->folder)->simplePaginate(40)
        ]);
    }
}
