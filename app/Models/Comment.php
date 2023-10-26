<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idkomentar',
        'idbuku',
        'noktp',
        'komentar'

    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'idbuku');
    }
}
