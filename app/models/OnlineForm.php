<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class OnlineForm extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public $table = 'online_forms';

	protected $fillable = array('form_num', 'category', 'created_by', 'status');

	public function requestForPayment()
    {
        return $this->hasOne('RequestForPayment', 'form_num', 'form_num');
    }

}