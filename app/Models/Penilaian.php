<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kandidat',
    ];

    // Relasi dengan `DetailPenilaian`
    public function detailPenilaians()
    {
        return $this->hasMany(DetailPenilaian::class);
    }
}
