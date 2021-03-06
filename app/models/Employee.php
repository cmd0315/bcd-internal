<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	public $timestamps = false;

	protected $fillable = array('username', 'first_name', 'middle_name', 'last_name', 'email', 'mobile', 'department_id', 'position');

	protected $touches = array('account');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

	public function account() {
        return $this->belongsTo('Account', 'username', 'username');
    }

    public function department() {
        return $this->belongsTo('Department', 'department_id', 'department_id');
    }

    public function scopeDepartmentID($query, $department_id) {
        return $query->where('department_id', '=', $department_id);
    }

    public function scopeHead($query) {
    	return $query->where('position', '1');
    }
}
