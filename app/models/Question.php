<?php

class Question extends \Eloquent {
	protected $fillable = [];

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->body);
	}


	/**
	 * Get the question's choices.
	 *
	 * @return array
	 */
	public function choices()
	{
		return $this->hasMany('Choice');
	}

	/**
	 * Returns the date of the question creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of the question last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at);
	}
}