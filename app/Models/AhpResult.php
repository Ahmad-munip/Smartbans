<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhpResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_id',
        'bobot',
        'lambda_max',
        'consistency_index',
        'consistency_ratio',
        'is_consistent',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
