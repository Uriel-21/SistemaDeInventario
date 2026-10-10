<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AjustesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $ajustes;

    public function __construct($ajustes)
    {
        $this-> ajustes = $ajustes;
    }

    public function collection() : collection
    {
        return $this -> ajustes;
    }

    public function map($ajuste): array
    {
        return [
            $ajuste->materiaPrima->nombre ?? 'N/A',
            $ajuste->cantidad_dm,
            $ajuste->user->name ?? 'N/A',
            $ajuste->created_at->format('d/m/Y H:i')
        ];
    }

    public function headings(): array
    {
        return [
            ['Reporte de Ajustes de Inventario - Guantes Mena Tapia'],
            [],
            ['Material', 'Cantidad (dm)', 'Registrado por', 'Fecha y hora']
        ];
    }

    public function styles(Worksheet $sheet) : array
    {
        $sheet->mergeCells('A1:E1');

        return [

            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['argb' => 'FF1A202C']],
                'alignment' => ['horizontal' => 'center']
            ],
            3 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF1E293B']
                ]
            ],
        ];
    }
}
