<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAction extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'request_action_id';
    protected $table = 'request_action';
    protected $fillable = [
        'request_id','action_id','transition_id','isActive','isComplete'
    ];
    public $timestamps = false;
}
