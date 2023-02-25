<?php

namespace App\Imports;

use App\Models\RoomCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class RoomCategoryImport implements ToModel
{
    public function model(array $row)
    {
        $categoryExists = RoomCategory::where('name',$row[0])->exists();
        $category = Str::random(8);
        return new RoomCategory([
            'name' => $categoryExists ? $category : $row[0],
            'description' => $row[1],
            'slug' => Str::slug($categoryExists ? $category : $row[0])
        ]);
    }
}
