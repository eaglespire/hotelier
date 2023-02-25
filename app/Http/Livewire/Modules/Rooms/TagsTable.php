<?php

namespace App\Http\Livewire\Modules\Rooms;

use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class TagsTable extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';
    public $searchTerm = '';
    public $headers = ['S/N','Title','Actions'];

    protected $listeners = ['refreshComponent'=>'$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function deleteTag($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            $this->emitSelf('success','Tag removed successfully');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            $this->emitSelf('error','Tag not found');
        }
        return back();
    }
    public function render()
    {
        return view('livewire.modules.rooms.tags-table', [
            'tags' => Tag::search(['title'], $this->searchTerm)
                        ->latest()->select('slug','title','id')
                        ->simplePaginate()
        ]);
    }
}
