<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }

    public function nilaiWargas()
    {
        return $this->hasMany(NilaiWarga::class, 'kriteria_id');
    }
}
