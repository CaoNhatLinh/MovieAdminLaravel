<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;
    protected $table = 'Quyen';
    protected $primaryKey = 'MaQuyen';
    public $timestamps = false;
    protected $keyType = 'string';
    public function User()
    {
        return $this->hasMany(User::class, 'MaQuyen'); 
    }
}