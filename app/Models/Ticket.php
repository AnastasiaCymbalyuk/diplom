<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Place;
use App\Models\Session;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = [
        'place_id', 
        'session_id',
        'date',
        'type',
        'price',
        'row',
        'place',
        'qr' 
    
    ];
    use HasFactory;
    protected $guarded = false;

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
