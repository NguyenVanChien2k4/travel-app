<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picks extends Model
{
    use HasFactory;
    protected $table = 'picks';
    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = ['name', 'area', 'continent', 'picks', 'desc', 'img', 'img_continent'];
}
