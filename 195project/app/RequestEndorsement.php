<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestEndorsement extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'request_eid';
    protected $dates = ['starting_date','end_date'];
    protected $table = 'request_endorsement';
    protected $fillable = [
        'request_id', 'isEndorsed', 'endorser', 'comment'
    ];
    public $timestamps = false;
}
