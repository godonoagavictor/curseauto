<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'itinerary_id',
        'name',
        'phone',
        'count',
        'two_way',
        'note',
        'status',
    ];

    protected $casts = [
        'two_way' => 'boolean'
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
