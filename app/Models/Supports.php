<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supports extends Model
{
    use HasFactory;
    protected $table = 'supports';
    protected $primaryKey = 'id';

    public $timestamps = false;
    
    protected $fillable = ['name', 'email', 'phone', 'address', 'content', 'date'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
