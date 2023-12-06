<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Hall;

class Place extends Model
{
    protected $table = 'places';
    protected $fillable = [
        'hall_id', 'type', 'row', 'place'
    ];
    use HasFactory;
    protected $guarded = false;

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'id');
    }
}
