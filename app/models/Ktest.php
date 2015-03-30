<?php

class Ktest extends \Eloquent {
	protected $fillable = [];
	public function colleges(){
    return $this->belongsTo('Scmmatch','co_id');
    }
}