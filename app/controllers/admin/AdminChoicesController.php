<?php

class AdminChoicesController extends \BaseController {
	
    public function __construct()
    {
        parent::__construct();        
    }

	/**
	 * Display a listing of the resource.
	 * GET /choices
	 *
	 * @return Response
	 */
	public function index()
	{
		// Title
        $title = Lang::get('admin/choices/title.choice_management');

        // Grab all the choices
        
		$choices = Choice::all();

		return View::make('admin.choices.index', compact('choices','title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /choices/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// Title
        $title = Lang::get('admin/choices/title.create_a_new_choice');
        
        $questions = Question::lists('title', 'id');

		return View::make('admin.choices.create', compact('title','questions'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /choices
	 *
	 * @return Response
	 */
	public function store()
	{
		// Declare the rules for the form validation
        $rules = array(
            'question_id'   => 'required|integer',
            'title'   => 'required|min:3',
            'body' => 'required|min:3',
            'correct_choice' => 'required|alpha',
            'correct_mark' => 'required|numeric'
        );		

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->passes())
		{			
			$choice = new Choice;
			$choice->question_id = Input::get('question_id');
			$choice->title = Input::get('title');
			$choice->body = Input::get('body');
			$choice->correct_choice = Input::get('correct_choice');
			$choice->correct_mark = Input::get('correct_mark');

			// Was the choice inserted?
            if($choice->save())
            {
                // Redirect to the choice page
                return Redirect::to('admin/choices/' . $choice->id . '/edit')->with('success', Lang::get('admin/choices/messages.update.success'));
            }
            else
            {
            	// Redirect to the choices management page
            	return Redirect::to('admin/choices/create')->with('error', Lang::get('admin/choices/messages.create.error'));
            }
			
		}
		else
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// if somehow arrive here

		return Redirect::route('admin.choices.index');		
	}

	/**
	 * Display the specified resource.
	 * GET /choices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$choice = Choice::findOrFail($id);

		return View::make('admin.choices.show', compact('choice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /choices/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Title
        $title = Lang::get('admin/choices/title.create_a_new_choice');

		$choice = Choice::find($id);

		$questions = Question::lists('title', 'id');
		
		// dd($choice->toArray());		

		return View::make('admin.choices.edit', compact('choice','questions','title'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /choices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Declare the rules for the form validation
        $rules = array(
            'question_id'   => 'required|integer',
            'title'   => 'required|min:3',
            'body' => 'required|min:3',
            'correct_choice' => 'required|alpha',
            'correct_mark' => 'required|numeric'
        );

		$choice = Choice::findOrFail($id);

		$validator = Validator::make($data = Input::all(), $rules);

		if ($validator->passes())
		{
			
			$choice->question_id = Input::get('question_id');
			$choice->title = Input::get('title');
			$choice->body = Input::get('body');
			$choice->correct_choice = Input::get('correct_choice');
			$choice->correct_mark = Input::get('correct_mark');

			// Was the choice updated?
            if($choice->save())
            {
                // Redirect to the choice page
                return Redirect::to('admin/choices/' . $choice->id . '/edit')->with('success', Lang::get('admin/choices/messages.update.success'));
            }
            else
            {
            	// Redirect to the blogs post management page
            	return Redirect::to('admin/choices/' . $choice->id . '/edit')->with('error', Lang::get('admin/choices/messages.update.error'));
            }
			
		}
		else
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// if somehow arrive here

		return Redirect::route('admin.choices.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /choices/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Choice::destroy($id);            

		// Was the blog post deleted?
		$choice = Choice::find($id);
		
		if(empty($choice))
		{
		    // Redirect to the blog posts management page
		    return Redirect::to('admin/choices')->with('success', Lang::get('admin/choices/messages.delete.success'));
		}

        // There was a problem deleting the blog post
        return Redirect::to('admin/choices')->with('error', Lang::get('admin/choices/messages.delete.error'));
	}

	/**
     * Show a list of all the choices formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $choices = Choice::leftjoin('questions', 'questions.id', '=', 'choices.question_id')
        				->select(array('choices.id', 'choices.title', 'questions.title as question_title', 'choices.created_at'));

        return Datatables::of($choices)        

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/choices/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/choices/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger delete">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }



}
