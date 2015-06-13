<?php

class Collect extends \Eloquent {
	protected $fillable = [];
	protected $table = 'collect';  
	public function user(){
    return $this->belongsTo('User','user_id');
    }
	public function college(){
    return $this->belongsTo('College','co_id');
    }
	public function career(){
    return $this->belongsTo('Career','career_id');
	}
}