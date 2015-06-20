<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Careervideo extends \Eloquent {
	protected $fillable = [];
	protected $searchable = [
        'columns' => [
            'ktitle' => 10,
        ],
    ];
}