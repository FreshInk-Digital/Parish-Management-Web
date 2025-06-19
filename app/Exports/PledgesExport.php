<?php

namespace App\Exports;

use App\Models\Pledge;
use Maatwebsite\Excel\Concerns\FromCollection;

class PledgesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pledge::all();
    }
}
