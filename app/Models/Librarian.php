<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Librarian extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idpetugas',
        'nama',
        'email',
        'password',
    ];
}
