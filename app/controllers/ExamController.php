<?php

class ExamController extends BaseController {

    /**
     * Question Model
     * @var Question
     */
    protected $question;

    /**
     * Choice Model
     * @var Choice
     */
    protected $choice;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Post $question
     * @param User $user
     */
    public function __construct(Question $question, Choice $choice, User $user)
    {
        parent::__construct();

        $this->question = $question;
        $this->choice = $choice;
        $this->user = $user;
    }
    
	/**
	 * Returns all the blog choices.
	 *
	 * @return View
	 */
	public function index()
	{
		// Get all the blog posts
		$questions = $this->question->orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('site/exam/index', compact('questions'));
	}

	
}
