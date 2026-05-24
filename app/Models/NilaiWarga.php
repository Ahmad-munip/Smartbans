<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiWarga extends Model
{
    use HasFactory;

    protected $table = 'nilai_wargas';
    protected $guarded = [];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
