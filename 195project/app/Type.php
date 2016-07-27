<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'type_id';
    protected $table = 'type';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
}
