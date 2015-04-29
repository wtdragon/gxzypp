<?php

class Flzhuanye extends \Eloquent {
	protected $fillable = [];
	protected $table = 'flzhuanye';  
	public function yjfl(){
    return $this->belongsTo('Yierjifl','yjfldm');
    }
	public function xkfl(){
    return $this->belongsTo('Yierjifl','xkfldm');
    }
}