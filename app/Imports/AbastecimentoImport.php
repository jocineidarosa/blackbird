<?php

namespace App\Imports;

use App\Models\Abastecimento;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class AbastecimentoImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    use Importable;
    
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Abastecimento::create([
                'equipamento_id' => $row[0],
                'produto_id' => $row[1],
                'quantidade' => $row[2],
                'data' => $row[3],
                'created_at' => $row[4],
                'updated_at' => $row[5],
                'medidor_inicial' => $row[6],
                'medidor_final' => $row[7],
                'horimetro' => $row[8],
                'hora' => $row[9],
            ]);
        }
    }

/*     public function model(array $row)
    {
        $abastecimento = new Abastecimento([
            'equipamento_id' => $row[0],
            'produto_id' => $row[1],
            'quantidade' => $row[2],
            'data' => $row[3],
            'created_at' => $row[4],
            'updated_at' => $row[5],
            'medidor_inicial' => $row[6],
            'medidor_final' => $row[7],
            'horimetro' => $row[8],
            'hora' => $row[9],
        ]);
        return new Collection([$abastecimento]);
    } */
}
