<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',

    ];
    public function villes()
    {
        return $this->hasMany(ville::class);
    }

    public function evenements()
    {
        return $this->hasMany(Evenements::class);
    }
}
