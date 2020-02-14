<?php

namespace App;

use Illuminate\Database\Eloquent\Model;









class ApiUser extends Model
{
    public $table= 'tbl_users';
    protected $fillable = [
        'first_name',
        'sur_name',
        'agent_id',
        'email',
        'login_name',
        'password',
        'operatorLevel',
        'status',
        'isDeleted',
    ];

    

    public function agent()
    {
        return $this->belongsTo('App\ApiAgent', 'agent_id', 'id');
    }
}
