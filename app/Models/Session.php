<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Hall;
use App\Models\Movie;

class Session extends Model
{
    protected $table = 'sessions';
    protected $fillable = [
        'hall_id', 'time', 'movie_id'
    ];
    use HasFactory;
    protected $guarded = false;

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'id');
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }
}
