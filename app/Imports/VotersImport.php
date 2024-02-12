<?php

namespace App\Imports;

use App\Models\Voters;
use Maatwebsite\Excel\Concerns\ToModel;

class VotersImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Voters([
            'nama_voters' => $row[1],
            'username' => $row[2],
            'usia' => $row[3], 
            'alamat' => $row[4], 
            'rt' => $row[5],
            'rw' => $row[6],
            'desa' => $row[7],
            'kecamatan' => $row[8],
            'kota' => $row[9],
            'no_hp' => $row[10],
            'id_tps' => $row[11],
            'id' => $row[12],
        ]);
    }
}
