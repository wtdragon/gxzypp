<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class School extends \Eloquent {
	protected $fillable = [];
	protected $table = 'school';  
	use SearchableTrait;
	protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];
}