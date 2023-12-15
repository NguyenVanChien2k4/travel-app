<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = ['point_start', 'point_end', 'rank', 'sale'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
