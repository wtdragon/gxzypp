<?php

class Province extends \Eloquent {
	protected $fillable = [];
	protected $table = 'province';  
	protected $primaryKey = 'cityID';
	public function cities(){
    return $this->hasMany('City');
	}
	public function colleges(){
    return $this->hasMany('College');
	}
}