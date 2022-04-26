<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'entity_id',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }
}
