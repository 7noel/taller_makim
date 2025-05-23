<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromView, WithStyles, ShouldAutoSize
{
    public function __construct($view, $models)
    {
        $this->view = $view;
        $this->models = $models;
    }

    public function view(): View
    {
        return view($this->view, ['models' => $this->models]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Aplica negrita a la primera fila (encabezados)
            1 => ['font' => ['bold' => true]],
        ];
    }
}