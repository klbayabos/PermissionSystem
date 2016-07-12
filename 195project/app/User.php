<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'type_id', 'team_id', 'isOIC',  'OIC_starting_date', 'OIC_end_date', 'tag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['OIC_starting_time, OIC_end_time'];
}
