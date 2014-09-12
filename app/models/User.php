<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $guarded = array('id', 'password');
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function nivelDeAcceso() {
        return $this->belongsToMany('NivelesDeAcceso', 'nivelesDeAcceso_users', 'user_id', 'nivelesDeAcceso_id');
	}
	protected $hidden = array('password', 'remember_token');

}
