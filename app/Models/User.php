<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamp = true;
    protected $fillable = ['name', 'email', 'role', 'password', 'address', 'phone', 'birth', 'gender', 'avatar', 'point'];

    public function bookings() {
        return $this->hasMany(Booking::class, 'user_id');
    }
}
