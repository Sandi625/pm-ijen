<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_id',
        'subkriteria_id',
        'nilai',
    ];

    // Relasi dengan `Penilaian`
    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }

    // Relasi dengan `Subkriteria`
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class);
    }
}
