<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Session;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = [
        'name',
    ];
    use HasFactory;
    protected $guarded = false;

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'session_id', 'id');
    }
}
