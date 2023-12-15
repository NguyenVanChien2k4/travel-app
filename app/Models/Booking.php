<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = ['user_id', 'tour_id', 'name', 'email', 'phone', 'address', 'adult', 'children', 'young', 'baby', 
    'note', 'pay', 'price', 'sale'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tour() {
        return $this->belongsTo(Tours::class, 'tour_id');
    }
}
