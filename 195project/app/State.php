<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'state_id';
    protected $table = 'state';
    protected $fillable = [
		'state_type_id','process_id','name'
    ];
    public $timestamps = false;
}
