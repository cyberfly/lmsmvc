<?php

class AdminQuestionsController extends \BaseController {

    public function __construct()
    {
        parent::__construct();        
    }

	/**
	 * Display a listing of the resource.
	 * GET /questions
	 *
	 * @return Response
	 */
	public function index()
	{
		// Title
        $title = Lang::get('admin/questions/title.question_management');

        // Grab all the blog posts
        
		$questions = Question::all();

		return View::make('admin.questions.index', compact('questions','title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /questions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// Title
        $title = Lang::get('admin/questions/title.create_a_new_question');

		return View::make('admin.questions.create', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /questions
	 *
	 * @return Response
	 */
	public function store()
	{
		// Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'body' => 'required|min:3'
        );		

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->passes())
		{			
			$question = new Question;
			$question->title = Input::get('title');
			$question->body = Input::get('body');

			// Was the question inserted?
            if($question->save())
            {
                // Redirect to the question page
                return Redirect::to('admin/questions/' . $question->id . '/edit')->with('success', Lang::get('admin/questions/messages.update.success'));
            }
            else
            {
            	// Redirect to the questions management page
            	return Redirect::to('admin/questions/create')->with('error', Lang::get('admin/questions/messages.create.error'));
            }
			
		}
		else
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// if somehow arrive here

		return Redirect::route('admin.questions.index');		
	}

	/**
	 * Display the specified resource.
	 * GET /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$question = Question::findOrFail($id);

		return View::make('admin.questions.show', compact('question'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /questions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Title
        $title = Lang::get('admin/questions/title.create_a_new_question');

		$question = Question::find($id);
		
		// dd($question->toArray());		

		return View::make('admin.questions.edit', compact('question','title'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'body' => 'required|min:3'
        );

		$question = Question::findOrFail($id);

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->passes())
		{
			
			$question->title = Input::get('title');
			$question->body = Input::get('body');

			// Was the question updated?
            if($question->save())
            {
                // Redirect to the question page
                return Redirect::to('admin/questions/' . $question->id . '/edit')->with('success', Lang::get('admin/questions/messages.update.success'));
            }
            else
            {
            	// Redirect to the blogs post management page
            	return Redirect::to('admin/questions/' . $question->id . '/edit')->with('error', Lang::get('admin/questions/messages.update.error'));
            }
			
		}
		else
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// if somehow arrive here

		return Redirect::route('admin.questions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Question::destroy($id);            

		// Was the blog post deleted?
		$question = Question::find($id);

		if(empty($question))
		{
		    // Redirect to the blog posts management page
		    return Redirect::to('admin/questions')->with('success', Lang::get('admin/questions/messages.delete.success'));
		}

        // There was a problem deleting the blog post
        return Redirect::to('admin/questions')->with('error', Lang::get('admin/questions/messages.delete.error'));
	}

	/**
     * Show a list of all the questions formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $questions = Question::select(array('questions.id', 'questions.title', 'questions.id as choices', 'questions.created_at'));

        return Datatables::of($questions)

        ->edit_column('choices', '{{ DB::table(\'choices\')->where(\'question_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/questions/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/questions/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger delete">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}