<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama',
        'id_user',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
}
