<?php

namespace App\Http\Livewire\Modules\Files;

use App\Models\FileManager;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFile extends Component
{
    use WithFileUploads;
    public $export = false;
    public $import = false;
    public $files = [];
    public $title;
    public $folder;
    public $mode;
    public $width;
    public $height;
    public $increments;

    protected $rules = [
        'files.*' => ['required','image','max:1024'],
        'title' => ['required','string'],
        'folder' => ['required'],
        'width' => ['nullable','numeric','min:10'],
        'height' => ['nullable','numeric','min:10'],
    ];

    public function mount()
    {
        $this->fill([
            'width' => null,
            'height' => null,
            'folder' => 'posts',
            'title' => null,
            'mode' => 'fit',
            'increments' => 1
        ]);
    }

    public function SaveFile()
    {
        $this->validate();
        //replace multiple white spaces in the received string with a single white space
        $output = preg_replace('!\s+!', ' ', $this->title);
        $titles = explode(',',$output);

        $photos = $this->UploadFiles();
        for ($i=0;$i<count($photos); $i++){
            FileManager::create([
                'src' => $photos[$i],
                'title' => $titles[$i] ?? 'Photo',
                'folder' => $this->folder,
                'slug' => Str::slug(Str::random())
            ]);
        }
        $this->increments++;
        $this->reset(['folder','title','mode','width','height']);
        $this->emitSelf('success','Upload successful');
    }

    private function UploadFiles(): array
    {
        $paths = [];
        foreach ($this->files as $file){
            if (!empty($this->width) && !empty($this->height)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=>'site',
                    'transformation'=>[
                        'crop' => $this->mode,
                        'width' => $this->width,
                        'height' => $this->height,
                    ]
                ])->getSecurePath();
            }
            elseif (!empty($this->width)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=>'site',
                    'transformation'=>[
                        'crop' => $this->mode,
                        'width' => $this->width,
                    ]
                ])->getSecurePath();
            }
            elseif (!empty($this->height)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=>'site',
                    'transformation'=>[
                        'crop' => $this->mode,
                        'height' => $this->height,
                    ]
                ])->getSecurePath();
            }
            else{
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=>'site',
                    'transformation'=>[
                        'crop' => $this->mode,
                    ]
                ])->getSecurePath();
            }
            $paths[] = $path;
        }
        return $paths;
    }

    public function render()
    {
        return view('livewire.modules.files.add-file');
    }
}
