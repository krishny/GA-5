<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiIntroducer extends Model
{
    public $table ='tbl_introducer';
    protected $fillable = [
        'int_id',
        'introducer_ref',
        'contact_name',
        'comp_name',
        'address',
        'phone_no',
        'fax_no',
        'email',
        'url',
        'status',
        'isDeleted',

    ];
}
