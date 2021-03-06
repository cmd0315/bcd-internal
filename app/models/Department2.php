<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
// use Illuminate\Database\Eloquent\SoftDeletingTrait; /* Maybe delete */

class Department extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	// use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $fillable = array('department_id', 'department', 'status');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departments';
	protected $softDelete = true;

	public function employee()
    {
        return $this->hasOne('Employee', 'department_id', 'department_id');
    }
}
