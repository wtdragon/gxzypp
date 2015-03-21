<?php

class Teacher extends \Eloquent {
	protected $fillable = [];
	public function sclass(){
    return $this->belongsTo('Sclass','classid');
    }
	public function school(){
    return $this->belongsTo('Mschool','schoolid');
    }
}