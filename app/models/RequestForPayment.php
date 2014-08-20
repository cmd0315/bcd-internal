<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class RequestForPayment extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public $table = 'rfps';
	public $timestamps = false;

	protected $fillable = array('form_num', 'control_num', 'payee', 'date_requested', 'particulars', 'total_amount', 'client', 'check_num', 'requested_by', 'department_id', 'date_needed', 'approved_by', 'received_by', 'stage', 'status');

	public function form()
    {
        return $this->belongsTo('OnlineForm', 'form_num', 'form_num');
    }

}