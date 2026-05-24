<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhpComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_pertama_id',
        'kriteria_kedua_id',
        'nilai',
    ];

    public function kriteriaPertama()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_pertama_id');
    }

    public function kriteriaKedua()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_kedua_id');
    }
}
