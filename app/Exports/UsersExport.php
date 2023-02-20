<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Database\Eloquent\Builder
     */
    public function collection()
    {
        return User::select('firstname','lastname','email','created_at')->get();
    }
    public function headings() : array
    {
        return ['firstname','lastname','email','Date Created'];
    }
}
