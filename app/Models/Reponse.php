<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'aideAdmin_id',
    ];

    public function reponseAides()
    {
        return $this->belongsTo(AideAdmin::class);
    }
}
