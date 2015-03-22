<?php

class Student extends \Eloquent {
	protected $fillable = [];
	public function sclass(){
    return $this->belongsTo('Sclass','classid');
    }
	public function school(){
    return $this->belongsTo('Mschool','schoolid');
    }
	public function teachers(){
    return $this->hasMany('Teacher','tid');
	}
	public function ktest(){
    return $this->hasMany('Ktest','tid');
	}
}