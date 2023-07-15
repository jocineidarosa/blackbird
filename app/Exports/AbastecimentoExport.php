<?php

namespace App\Exports;

use App\Models\Abastecimento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpParser\Node\Expr\FuncCall;

class AbastecimentoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Abastecimento::all();
    }

    public function view(): View {
        return view('abastecimento.export_excel');
    }
}
