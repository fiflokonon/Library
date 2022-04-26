<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'lastName',
        'firstName',
        'sexe',
        'email',
        'tel',
        'password',
        'role_id',
        #'entity_id',
        #'speciality_id',
        #'profileImg',
    ];

    /*public function speciality()
    {
        return $this->belongsTo(Speciality::class);
    }

  public function entity()
    {
        return $this->belongsTo(Entity::class);
    }*/

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
