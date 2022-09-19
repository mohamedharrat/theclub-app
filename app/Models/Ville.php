<?php

namespace App\Models;

use App\Models\Region;
use App\Models\Evenements;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'region_id',
    ];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function evenements()
    {
        return $this->hasMany(Evenements::class);
    }
}
