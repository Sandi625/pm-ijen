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

    // Relasi ke Kriteria
    // public function kriteria()
    // {
    //     return $this->belongsTo(Kriteria::class);
    // }




    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');  // assuming kriteria_id is a column on guides table
    }








    // Relasi ke Pesanan
    // public function pesanan()
    // {
    //     return $this->hasMany(Pesanan::class);
    // }

    public function pesanan()
{
    return $this->hasMany(Pesanan::class, 'id_guide');
}



public function kriteriaUnggulan()
{
    return $this->belongsTo(Kriteria::class, 'kriteria_id')->where('is_unggulan', true);  // assuming 'is_unggulan' is a column
}


}

