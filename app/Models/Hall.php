<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Place;

class Hall extends Model
{
    protected $table = 'halls';
    protected $fillable = [
        'name',
        'row',
        'place',
        'price',
        'vipPrice',
        'isActive',
    ];
    use HasFactory;
    protected $guarded = false;

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'hall_id', 'id');
    }
}
