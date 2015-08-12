<?php

class Collect extends \Eloquent {
	protected $fillable = [];
	protected $table = 'collect';  
	public function user(){
    return $this->belongsTo('User','userid');
    }
	public function colleges(){
    return $this->belongsTo('Zylb','coid','coid');
    }
 
}