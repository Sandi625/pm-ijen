<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';
    protected $primaryKey = 'id';
    public $timestamps = true; // Mengaktifkan created_at & updated_at

    protected $fillable = [
    'nama',
    'email',
    'nomor_telp',
    'id_kriteria',
    'id_paket',
    'tanggal_pesan',
    'tanggal_keberangkatan',
    'jumlah_peserta',
    ];

    // Relasi ke Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }

    // Relasi ke Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
