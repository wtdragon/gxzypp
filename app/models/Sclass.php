<?php

class Sclass extends \Eloquent {
	protected $table = 'sclasses';  
	protected $fillable = [];
	public function teachers(){
    return $this->hasMany('Teacher','tid');
	}
	public function school(){
    return $this->belongsTo('Mschool','schoolid');
    }
}