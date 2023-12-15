<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use HasFactory;
    protected $table = 'tour_guides';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'email', 'phone', 'birth'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
