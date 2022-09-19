<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenements extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'date_heure',
        'duree',
        'region',
        'city',
        'adresse',
        'author_id',
        'category_id',
    ];


    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function villes()
    {
        return $this->belongsTo(Ville::class);
    }

    // public function categories()
    // {
    //     return $this->hasMany(Categories::class);
    // }
}
