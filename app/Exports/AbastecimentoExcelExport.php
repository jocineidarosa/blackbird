<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AbastecimentoExcelExport implements FromView, ShouldAutoSize, WithStyles
{

    protected $abastecimentos;
    protected $total_quant;

    public function __construct($abastecimentos, $total_quant)
    {
        $this->abastecimentos = $abastecimentos;
        $this->total_quant = $total_quant;
    }

    public function view(): View
    {
        return view('app.abastecimento.export_excel', [
            'abastecimentos' => $this->abastecimentos,
            'total_quant' => $this->total_quant,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $range = 'A1:' . $highestColumn . $highestRow;

        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); // Define a borda sólida simples em todas as células com conteúdo

        return $sheet;
    }
}
