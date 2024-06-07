<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'Phim';
    protected $primaryKey = 'MaPhim';
    public $timestamps = false;
    public function theloais()
    {
        return $this->belongsToMany(TheLoai::class, 'Phim_TheLoai', 'MaPhim', 'MaTheLoai');
    }
    public function phimTheLoai()
    {
        return $this->hasMany(Phim_TheLoai::class,'MaPhim');
    }
    public function tapPhims()
    {
        return $this->hasMany(TapPhim::class, 'MaPhim', 'MaPhim');
    }
}
