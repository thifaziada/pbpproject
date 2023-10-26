<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idtransaksi',
        'idbuku',
        'tgl_kembali',
        'denda',
        'id_petugas',
    ];
}
