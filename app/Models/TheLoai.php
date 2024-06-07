<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table = 'TheLoai';
    protected $primaryKey = 'MaTheLoai';
    public $timestamps = false;
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'Phim_TheLoai', 'MaTheLoai', 'MaPhim');
    }
}
