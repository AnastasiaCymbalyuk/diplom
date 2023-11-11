<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Place;

class Hall extends Model
{
    protected $table = 'halls';
    protected $fillable = [
        'name', 'isActive',
    ];
    use HasFactory;
    protected $guarded = false;

    public function places() 
    {
        return $this->hasMany(Place::class, 'hall_id', 'id');
    }
}
