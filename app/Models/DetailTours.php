<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTours extends Model
{
    use HasFactory;
    protected $table = 'detail_tours';
    protected $primaryKey = 'id_tour';
    protected $fillable = ['day', 'title', 'descrip', 'img_1', 'img_2'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
