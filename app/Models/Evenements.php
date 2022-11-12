<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenements extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'date',
        'heure',
        'duree',
        'region',
        'city',
        'adresse',
        'lieu',
        'author_id',
        'category_id',
        'players_number',
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

    public function players()
    {
        return $this->belongsToMany(User::class, 'evenements_user');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'evenement_user_like');
    }

    public function isLiked()
    {
        return Auth::user()->likes->contains('id', $this->id);
    }



    // public function categories()
    // {
    //     return $this->hasMany(Categories::class);
    // }
}
