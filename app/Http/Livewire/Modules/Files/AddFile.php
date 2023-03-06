<?php

namespace App\Http\Livewire\Modules\Files;

use App\Models\FileManager;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFile extends Component
{
    use WithFileUploads;
    public $export = false;
    public $import = false;
    public $files = [];
    public $folder;
    public $mode;
    public $width;
    public $height;
    public $increments;
    public $file;

    protected $rules = [
        //'files' => ['required','image','max:1024'],
        'files.*' => ['required','image','max:1024'],
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
            'mode' => 'fit',
            'increments' => 1
        ]);
    }

    private function getFileName($file): string
    {
        $string = $file->getClientOriginalName();
        $exploded = explode('.',$string);
        return reset($exploded);
    }

    public function SaveFile()
    {
        try {
            $this->validate();
            //replace multiple white spaces in the received string with a single white space
            // $output = preg_replace('!\s+!', ' ', $this->title);
            //$titles = explode(',',$output);

            $arr = $this->UploadFiles();
            for ($i=0;$i<count($arr[0]); $i++){
                FileManager::create([
                    'src' => $arr[0][$i],
                    'title' => $arr[1][$i],
                    'folder' => $this->folder,
                    'slug' => Str::slug(Str::random())
                ]);
            }
            $this->increments++;
            $this->reset(['folder','mode','width','height']);
            $this->emitSelf('success','Upload successful');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            $this->emit('error','Please check your internet');
        }
        return redirect(request()->header('referer'));
    }

    private function UploadFiles(): array
    {
        $paths = [];
        $filenames = [];
        foreach ($this->files as $file){
            if (!empty($this->width) && !empty($this->height)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=> config('app.name'),
                    'transformation'=>[
                        'crop' => $this->mode,
                        'width' => $this->width,
                        'height' => $this->height,
                    ]
                ])->getSecurePath();
            }
            elseif (!empty($this->width)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=>config('app.name'),
                    'transformation'=>[
                        'crop' => $this->mode,
                        'width' => $this->width,
                    ]
                ])->getSecurePath();
            }
            elseif (!empty($this->height)){
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=> config('app.name'),
                    'transformation'=>[
                        'crop' => $this->mode,
                        'height' => $this->height,
                    ]
                ])->getSecurePath();
            }
            else{
                $path = Cloudinary::upload($file->getRealPath(), [
                    'folder'=> config('app.name'),
                    'transformation'=>[
                        'crop' => $this->mode,
                    ]
                ])->getSecurePath();
            }
            $paths[] = $path;
            $filenames[] = $this->getFileName($file);
        }
        return [$paths, $filenames];
    }

    public function render()
    {
        return view('livewire.modules.files.add-file');
    }
}
