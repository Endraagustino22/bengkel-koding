<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    protected $table = 'poli';

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokter()
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
}
