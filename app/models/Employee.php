<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	public $timestamps = false;

	protected $fillable = array('username', 'name', 'email', 'mobile', 'department', 'position');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

	public function account()
    {
        return $this->belongsTo('Account');
    }
}
