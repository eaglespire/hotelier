<?php

namespace App\Exports;

use App\Models\RoomCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomCategoryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return RoomCategory::select('name','description')->get();
    }
    public function headings() : array
    {
        return ['Name','Description'];
    }
}
