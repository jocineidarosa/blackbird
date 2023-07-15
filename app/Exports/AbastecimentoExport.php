<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbastecimentoExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $abastecimentos;
    protected $total_quant;
    public function __construct($abastecimentos, $total_quant)
    {
        $this->abastecimentos=$abastecimentos;
        $this->total_quant=$total_quant;
    }

    public function view(): View
    {
        return view('app.abastecimento.export_excel', [
            'abastecimentos' => $this->abastecimentos,
            'total_quant' => $this->total_quant,
        ]);
    }


}
