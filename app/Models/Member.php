<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'noktp',
        'nama',
        'password',
        'alamat',
        'kota',
        'email',
        'no_telp',
        'file_ktp'
    ];
}
