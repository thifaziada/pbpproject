<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'idbuku',
        'noktp',
        'skor_rating',
        'created_at'

    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'idbuku');
    }
}
