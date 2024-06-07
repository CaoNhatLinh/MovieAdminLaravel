<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TapPhim extends Model
{
    use HasFactory;
    protected $table = 'TapPhim';
    protected $primaryKey = 'MaTapPhim';
    public $timestamps = false;
    public function Phims()
    {
        return $this->belongsToMany(Movie::class, 'MaPhim','MaPhim');
    }
    
}