<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Kmajor extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $table = 'kmajors';  
	protected $searchable = [
        'columns' => [
            'english_name' => 10,
        ],
    ];
}