<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class RolesImport implements ToModel
{
    /**
    * @param Collection $collection
    */


    public function model(array $row)
    {
        return DB::table('roles')
            ->insert([
                'name' => $row[0],
                'title' => $row[1]
            ]);
    }
}
