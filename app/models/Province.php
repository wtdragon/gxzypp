<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Province extends \Eloquent {
	use SearchableTrait;	
	protected $fillable = [];
	protected $table = 'province';  
	protected $primaryKey = 'provinceID';
	public function cities(){
    return $this->hasMany('City','provinceID');
	}
	public function colleges(){
    return $this->hasMany('College','provinceID');
	}
	protected $searchable = [
        'columns' => [
            'pname' => 10,
        ],
    ];
}