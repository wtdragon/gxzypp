<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Careersalay extends \Eloquent {
	use SearchableTrait;
	protected $fillable = [];
	protected $table = 'careersalays';  
	protected $searchable = [
        'columns' => [
            'zhiye' => 10,
        ],
    ];
}