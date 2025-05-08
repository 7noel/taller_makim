<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
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
}