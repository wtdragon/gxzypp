<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Zylb extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $table = 'zylb';  
	protected $searchable = [
        'columns' => [
            'zymingcheng' => 20,
        ],
    ];
}