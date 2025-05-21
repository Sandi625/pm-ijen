<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'nomor_telp', 'id_kriteria', 'id_paket', 'id_guide',
        'tanggal_pesan', 'tanggal_keberangkatan', 'jumlah_peserta','order_id',
        'negara', 'bahasa', 'riwayat_medis', 'paspor', 'special_request','status', 'user_id', // <--- jangan lupa tambahkan ini
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

    // Relasi ke Guide
    public function guide()
    {
        return $this->belongsTo(Guide::class, 'id_guide');
    }

    // Model Pesanan.php

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}







}

