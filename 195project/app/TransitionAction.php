<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransitionAction extends Model
{
	protected $connection = 'mysql';
    protected $table = 'transition_action';
    protected $fillable = [
		''transaction_id','action_id'
    ];
    public $timestamps = false;
}
