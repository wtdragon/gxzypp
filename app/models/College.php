<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class College extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $primaryKey = 'coid';
	protected $table = 'college';  
	public function schools(){
    return $this->hasMany('School');
	}
	public function province(){
    return $this->belongsTo('Province');
    }
	public function city(){
    return $this->belongsTo('City');
    }
    public function area(){
    return $this->belongsTo('Area');
    }
	protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];
}