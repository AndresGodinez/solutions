<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use function compact;

class HojasConteoExport implements FromView, WithProperties, WithEvents, WithHeadings, ShouldAutoSize
{
    /**
     * @var string
     */
    protected $planta;

    public function __construct(string $planta)
    {
        $this->planta = $planta;
    }


    public function properties(): array
    {
        return [
            'title' => 'CONCILIACION CONTEO CICLICO',
            'description' => 'CONCILIACION CONTEO CICLICO',
            'subject' => 'CONCILIACION CONTEO CICLICO',
            'company' => 'WHIRLPOOL'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet
                    ->getPageSetup()
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'MATERIAL',
            'DESCRIPCION',
            'INV RECORD',
            'BIN',
            'INVENTARIO SISTEMA',
            'C UNIT ($)',
            'PRIMER CONTEO',
            'VARIACION',
            'SEGUNDO CONTEO',
            'AJUSTE INV',
            'IMPORTE AJUSTE ($)',
            'INVENTARIO FINAL',
            'VALOR INV ($)',
        ];
    }

    public function view(): View
    {
        $data = DB::connection('logistica')->table('ciclicos')->select(
            'material',
            'descripcion',
            'bin',
            'stock',
            'invrec',
            'costo'
        )
            ->where('planta', $this->planta)
            ->orderBy('type', 'asc')
            ->orderBy('bin', 'asc')
            ->orderBy('material', 'asc')
            ->get();

        $planta = $this->planta;
        $date = Carbon::now()->format('d/m/Y');

        return view('ConteoCiclos.xls', compact('data', 'planta', 'date'));
    }

}
