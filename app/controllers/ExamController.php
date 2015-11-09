<?php

class ExamController extends BaseController {

    /**
     * Exam Model
     * @var Exam
     */
    protected $exam;

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
    public function __construct(Exam $exam,Question $question, Choice $choice, User $user)
    {
        parent::__construct();

        $this->exam = $exam;
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

	public function create()
	{		
		$user = Auth::user();

		$this->exam->user_id = $user->id;
		$this->exam->start_at = date('Y-m-d H:i:s');

		// Was the exam inserted?
        if($this->exam->save())
        {
            // Redirect to the exam page
            return Redirect::to('exams/' . $this->exam->id . '/start')->with('success', Lang::get('admin/exams/messages.update.success'));
        }
        else
        {
        	// Redirect to the exams management page
        	return Redirect::to('exam/index')->with('error', Lang::get('admin/exams/messages.create.error'));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /exams/{id}/start
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function start($id)
	{
		// Title
        $title = Lang::get('exams/title.create_a_new_question');

		// Grab all the question posts
        $questions = Question::all();

        // Get this question comments
		// $comments = $question->comments()->orderBy('created_at', 'ASC')->get();
		
		// dd($questions->toArray());		

		return View::make('site.exam.start', compact('questions','title'));
	}

	
}
