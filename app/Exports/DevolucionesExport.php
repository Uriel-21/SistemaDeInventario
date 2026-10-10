<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DevolucionesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $devoluciones;

    public function __construct($devoluciones)
    {
        $this->devoluciones = $devoluciones;
    }

    public function collection() : collection
    {
        return $this -> devoluciones;
    }

    public function map($devolucion): array
    {
        return [
            $devolucion->materiaPrima->nombre ?? 'N/A',
            $devolucion->cantidad_dm,
            $devolucion->proveedor,
            $devolucion->user->name ?? 'N/A',
            $devolucion->created_at->format('d/m/Y H:i')
        ];
    }

    public function headings(): array
    {
        return [
            ['Reporte de Devoluciones - Guantes Mena Tapia'],
            [],
            ['Material', 'Cantidad (dm)', 'Proveedor', 'Registrado por', 'Fecha y hora']
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
