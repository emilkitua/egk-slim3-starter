<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
	protected $table = 'oo_user_permission';

	protected $fillable = [
		'ul_username',
		'up_is_admin',
	];

	public static $defaults = [
		'up_is_admin' => false
	];
}