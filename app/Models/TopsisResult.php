<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopsisResult extends Model
{
    use HasFactory;

    protected $table = 'topsis_results';
    protected $guarded = [];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
