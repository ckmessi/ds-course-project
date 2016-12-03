<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginRecord extends Model
{
    //
    protected $table = 'login_record';
    protected $primaryKey = 'login_record_id';

    public $timestamps = false;
}
