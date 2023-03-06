<?php

namespace App\Http\Controllers;

use App\Constants\CacheConstants;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Feature;
use App\Models\FileManager;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
    public function CreateRoom()
    {
        $features = Cache::remember(CacheConstants::FeaturesCache, now()->addDays(30), function (){
            return Feature::get();
        });
        $categories = Cache::remember(CacheConstants::RoomCategoriesCache, now()->addDays(30), function (){
            return RoomCategory::get();
        });
        $tags = Cache::remember(CacheConstants::TagsCache, now()->addDays(30), function (){
            return Tag::get();
        });
        $images = Cache::remember('cached-room-images', now()->addDays(30), function (){
            return FileManager::where('folder','rooms')->get();
        });
        $this->data['title'] = 'Create Room';
        $this->data['titleDesc'] = 'Add new room';
        $this->data['description'] = 'Add new room';
        $this->data['categories'] = $categories;
        $this->data['tags'] = $tags;
        $this->data['images'] = $images;
        $this->data['features'] = $features;
        return view('admin.rooms.create-room', $this->data);
    }
    public function StoreRoom(StoreRoomRequest $request)
    {
        try {
           $room = Room::create([
                'title' => $request['title'],
                'slug' => Str::slug($request['title']),
                'description' => $request['description'],
                'room_number' => $request['room_number'],
                'is_available' => $request['available'],
                'is_clean' => $request['clean'],
                'extra' => $request['extra'],
                'price' => $request['price'],
                'room_category_id' => $request['category'],
                'meta_title' => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keywords' => $request['meta_keywords'],
                'first_image' => $request['image_1'],
                'second_image' => $request['image_2'],
                'third_image' => $request['image_3'],
                'fourth_image' => $request['image_4'],
                'fifth_image' => $request['image_5'],
                'sixth_image' => $request['image_6'],
            ]);
           /*
            * Add features and tags
            */
            $room->features()->attach($request['features']);
            $room->tags()->attach($request['tags']);
            toast('Room added successfully','success');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
        return back();
    }
    public function EditRoom(Room $room)
    {
        $features = Cache::remember(CacheConstants::FeaturesCache, now()->addDays(30), function (){
            return Feature::get();
        });
        $categories = Cache::remember(CacheConstants::RoomCategoriesCache, now()->addDays(30), function (){
            return RoomCategory::get();
        });
        $tags = Cache::remember(CacheConstants::TagsCache, now()->addDays(30), function (){
            return Tag::get();
        });
        $images = Cache::remember('cached-room-images', now()->addDays(30), function (){
            return FileManager::where('folder','rooms')->get();
        });
        $this->data['title'] = 'Edit '. $room->title;
        $this->data['titleDesc'] = 'Edit '. $room->title;
        $this->data['description'] = 'Edit '. $room->title;
        $this->data['categories'] = $categories;
        $this->data['tags'] = $tags;
        $this->data['images'] = $images;
        $this->data['features'] = $features;
        $this->data['room'] = $room;
        return view('admin.rooms.edit-room', $this->data);
    }
    public function UpdateRoom(UpdateRoomRequest $request, int $id)
    {
        try {
            $room = Room::findOrFail($id);
            $room->update([
                'title' => $request['title'],
                'slug' => $request['title'],
                'description' => $request['description'],
                'room_number' => $request['room_number'],
                'is_available' => $request['available'],
                'is_clean' => $request['clean'],
                'extra' => $request['extra'],
                'price' => $request['price'],
                'room_category_id' => $request['category'],
                'meta_title' => $request['meta_title'],
                'meta_description' => $request['meta_description'],
                'meta_keywords' => $request['meta_keywords'],
                'first_image' => $request['image_1'],
                'second_image' => $request['image_2'],
                'third_image' => $request['image_3'],
                'fourth_image' => $request['image_4'],
                'fifth_image' => $request['image_5'],
                'sixth_image' => $request['image_6'],
            ]);
            if (!empty($request['tags']))
            {
                $room->tags()->sync($request['tags']);
            }
            if (!empty($request['features']))
            {
                $room->features()->sync($request['features']);
            }
            toast('Room updated','success');
        } catch (ModelNotFoundException $exception){
            Log::error($exception->getMessage());
            toast('Something went wrong','error');
        }
        return redirect(route('usr.room.all'));
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
