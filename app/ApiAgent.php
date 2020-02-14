<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiAgent extends Model
{
    public $table ='tbl_agents';
    protected $fillable = [
        'code',
        'name',
        'addressI',
        'addressII',
        'addressIII',
        'addressIV',
        'postcode',
        'website',
        'telephone_no',
        'fax_no',
        'letter_head',
        'logo_header_file',
        'blank_lines',
        'status',
        'type',
        'belongs_to',
        'isDeleted',

    ];
}
