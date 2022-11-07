<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AideAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'email',
        'content',
        'author_id',
        'status',

    ];
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
