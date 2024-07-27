<?php

namespace App\Exports;

use App\Models\Setoran;
use Maatwebsite\Excel\Concerns\FromCollection;

class SetoranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Setoran::all();
    }
}
