<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'periode',
    ];
}
