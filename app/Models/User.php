<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'oo_users'; //table name

    //set up fillables
    protected $fillable = [
        'u_email',
        'u_username',
        'u_full_name',
        'u_activated',
        'u_password',
        'u_active',
        'u_ip_address',
        'u_remember_token',
    ];
}
