<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'activity_id';
    protected $table = 'activity';
    protected $fillable = [
		'activity_type_id','process_id','name','description'
    ];
    public $timestamps = false;
}