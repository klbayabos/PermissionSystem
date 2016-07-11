<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestNote extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'request_note_id';
    protected $table = 'request_note';
    protected $fillable = [
        'request_id','user_id','note'
    ];
    public $timestamps = false;
}
