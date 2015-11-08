<?php

class Choice extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	/**
	 * Get the choices's question.
	 *
	 * @return array
	 */
	public function question()
	{
		return $this->hasOne('Question');
	}

}