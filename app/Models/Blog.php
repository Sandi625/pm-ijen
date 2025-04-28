<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // Nama tabel

    protected $primaryKey = 'id'; // Primary Key

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'status',
        'created_by',
        'updated_by',
    ];

    // Jika tidak mau pakai timestamps (created_at, updated_at)
    // public $timestamps = false;

    // Relasi ke User (opsional kalau nanti ada user)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
