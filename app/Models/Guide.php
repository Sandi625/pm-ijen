<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $table = 'guides';
    protected $primaryKey = 'id'; // Pastikan primary key sesuai

    public $timestamps = true; // Jika menggunakan timestamps

    protected $fillable = [
        'nama_guide', 'salary', 'kriteria_id', 'deskripsi_guide',
        'nomer_hp', 'status', 'alamat', 'email', 'foto', 'bahasa'
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'guide_id');
    }
}

