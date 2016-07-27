<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestApproval extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'request_aid';
    protected $table = 'request_approval';
    protected $fillable = [
        'request_id', 'isApproved', 'approved_dates', 'comment'
    ];
    public $timestamps = false;
}
