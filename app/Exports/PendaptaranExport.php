<?php

namespace App\Exports;

use App\Models\pendaptaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PendaptaranExport implements FromCollection
{
    public function collection()
    {
        return pendaptaran::where('status', 1)->orderBy('asal_sekolah', 'ASC')->get([
            'id',
            'nama',
            'asal_sekolah',
            'jenis_kelamin',
            'tanggal_lahir',
            'agama',
            'alamat',
            'file_id',
            'nilai_id',
            'created_at'
        ]);
    }
}
