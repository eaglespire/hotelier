<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\RoomCategory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoomController extends BaseController
{
    public function RoomCategories()
    {
        $this->data['title'] = 'Room Categories';
        $this->data['titleDesc'] = 'View Room Categories';
        $this->data['description'] = 'View Room Categories';
        return view('admin.rooms.categories', $this->data);
    }
    public function RoomCategory(string $slug)
    {
        $category = RoomCategory::where('slug',$slug)->first();
        $this->data['category'] = $category;
        $this->data['title'] = $category['name'];
        $this->data['titleDesc'] = 'View '. $category['name'];
        $this->data['description'] = 'View '. $category['name'];
        return view('admin.rooms.category', $this->data);
    }
    public function UpdateRoomCategory(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255', Rule::unique('room_categories')->ignore($request['id'])],
            'description' => ['nullable','string']
        ]);
        try {
            $category = RoomCategory::findOrFail($request['id']);
            $category->update([
                'name' => $request['name'],
                'description' => $request['description']
            ]);
            toast('Success','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
        return redirect(route('usr.room.categories'));
    }
    public function AllRooms()
    {
        $this->data['title'] = 'Manage Rooms';
        $this->data['titleDesc'] = 'Manage Rooms';
        $this->data['description'] = 'All Rooms';
        return view('admin.rooms.rooms',$this->data);
    }
    public function tags()
    {
        $this->data['title'] = 'Manage Tags';
        $this->data['titleDesc'] = 'Manage Tags';
        $this->data['description'] = 'All Tags';
        return view('admin.rooms.tags',$this->data);
    }
    public function tag(string $slug)
    {
        $tag = Tag::where('slug',$slug)->first();
        $this->data['tag'] = $tag;
        $this->data['title'] = "Manage $tag->title tag";
        $this->data['titleDesc'] = "Manage $tag->title tag";
        $this->data['description'] = "Manage $tag->title";
        return view('admin.rooms.tag',$this->data);
    }
    public function UpdateTag(Request $request)
    {
        $request->validate(['title'=>['required']]);
        try {
            $tag = Tag::findOrFail($request['id']);
            $tag->update([
                'title'=>$request['title'],
                'slug' => Str::slug($request['title'])
            ]);
            toast('Updated successfully','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('An error occurred','error');
        }
        return redirect(route('usr.room.tags'));
    }
    public function features()
    {
        $this->data['title'] = 'Manage Features';
        $this->data['titleDesc'] = 'Manage Features';
        $this->data['description'] = 'All Features';
        return view('admin.rooms.features',$this->data);
    }
    public function feature(string $slug)
    {
        $feature = Feature::where('slug',$slug)->first();
        $this->data['feature'] = $feature;
        $this->data['title'] = "Manage $feature->title feature";
        $this->data['titleDesc'] = "Manage $feature->title feature";
        $this->data['description'] = "Manage $feature->title";
        return view('admin.rooms.feature',$this->data);
    }
    public function UpdateFeature(Request $request)
    {
        $request->validate(['title'=>['required']]);
        try {
            $feature = Feature::findOrFail($request['id']);
            $feature->update([
                'title'=>$request['title'],
                'slug' => Str::slug($request['title']),
                'icon' => $request['icon']
            ]);
            toast('Updated successfully','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('An error occurred','error');
        }
        return redirect(route('usr.room.features'));
    }

}
