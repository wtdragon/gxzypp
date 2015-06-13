<?php

class Career extends \Eloquent {
	protected $fillable = [];
	public function video(){
    return $this->belongsTo('Video','video_id');
    }
}