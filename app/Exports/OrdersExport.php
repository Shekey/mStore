<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromArray, WithHeadings
{

    private $array;
    public function __construct($array)
    {
        $this->array = $array;
    }

    public function array(): array
    {
        return $this->array;
    }

    public function headings(): array
    {
        return [
            'Naziv',
            'Datum',
            'Kolicina',
            'Cijena',
            'Zarada',
            'Ukupno'
        ];
    }
}
