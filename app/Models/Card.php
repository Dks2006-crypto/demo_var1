<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_title',
        'book_author',
        'type',
        'published',
        'year',
        'binding',
        'book_condition',
        'status',
        'rejected_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
