<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function nilaiWargas()
    {
        return $this->hasMany(NilaiWarga::class, 'warga_id');
    }

    public function topsisResult()
    {
        return $this->hasOne(TopsisResult::class, 'warga_id');
    }
}
