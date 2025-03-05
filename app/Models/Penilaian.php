<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['guide_id']; // Pastikan ada guide_id

    // Relasi dengan `DetailPenilaian`
    public function detailPenilaians()
    {
        return $this->hasMany(DetailPenilaian::class);
    }

    public function guide()
{
    return $this->belongsTo(Guide::class, 'guide_id');
}
}
