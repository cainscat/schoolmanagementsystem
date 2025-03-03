<?php

namespace App\Exports;

use App\Models\StudentAddFeesModel;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportsCollectFees implements FromCollection, WithMapping
{
    public function map($user): array
    {

    }

    public function collection()
    {
        die;
    }
}
