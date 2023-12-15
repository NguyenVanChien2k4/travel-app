<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTours extends Model
{
    use HasFactory;
    protected $table = 'group_tours';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
    protected $fillable = ['name', 'start_day', 'end_day', 'icon', 'desc'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
