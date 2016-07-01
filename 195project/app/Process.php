<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'process_id';
    protected $table = 'process';
    protected $fillable = [
		'name'
    ];
    public $timestamps = false;
}