<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventlog extends Model
{
    public $table = 'tbl_eventlog';

    protected $fillable = [
        'email',
        'description',
        'action'
    ];
}
