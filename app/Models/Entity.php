<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;
    protected $table = "entities";
    protected $fillable = [
        'name',
    ];

    public function specialities()
    {
        return $this->hasMany(Speciality::class);
    }

   /* public function users()
    {
        return $this->hasMany(User::class);
    }*/
}
