<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;
    protected $table = 'tours';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = ['name', 'seat', 'departure', 'desstination', 'start_day', 'end_day', 'rally_time', 'start_time', 
    'schedule', 'type_tour', 'price', 'sale', 'ordered', 'flight', 'transport', 'hotel', 'addresstype', 'continent', 'status'];

    public function booking() {
        return $this->hasMany(Booking::class, 'tour_id');
    }
}
