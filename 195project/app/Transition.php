<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'transition_id';
    protected $table = 'transition';
    protected $fillable = [
		'process_id','current_state_id','next_state_id'
    ];
    public $timestamps = false;
}