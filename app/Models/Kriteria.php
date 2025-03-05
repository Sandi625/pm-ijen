<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan oleh model ini
    protected $table = 'kriterias';



    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'kode',
        'nama',
        'deskripsi',
    ];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }
}
