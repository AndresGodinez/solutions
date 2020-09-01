<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimpleExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * @var array
     */
    private $head;
    /**
     * @var array
     */
    private $data;

    public function __construct(array $head, array $data)
    {
        $this->head = $head;
        $this->data = $data;
    }


    public function headings(): array
    {
        return $this->head;
    }

    public function array(): array
    {
        return $this->data;
    }
}
