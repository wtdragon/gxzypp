<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Kcareer extends \Eloquent {
		use SearchableTrait;
	protected $fillable = [];
	protected $table = 'kcareers';  
	protected $searchable = [
        'columns' => [
            'english_name' => 10,
        ],
    ];
}