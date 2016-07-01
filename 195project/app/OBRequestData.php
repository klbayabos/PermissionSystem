<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OBRequestData extends Model
{
    protected $connection = 'mysql';
    protected $table = 'ob_request_data';
    protected $fillable = [
		'request_id','to','from'
    ];
    public $timestamps = false;
}