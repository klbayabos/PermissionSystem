<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'team_id';
    protected $table = 'team';
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
