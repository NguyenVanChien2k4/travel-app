<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    use HasFactory;
    protected $table = 'price_types';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'precent'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
