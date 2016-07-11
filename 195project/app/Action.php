<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'action_id';
    protected $table = 'action';
    protected $fillable = [
		'action_type_id','process_id','name','description'
    ];
}