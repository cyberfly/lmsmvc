<?php

class Exam extends \Eloquent {
	

	/**
	 * Get the question's choices.
	 *
	 * @return array
	 */
	public function questions()
	{
		return $this->hasMany('Question');
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