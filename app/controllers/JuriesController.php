<?php

class JuriesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//obtain all juries
		$juries = Jury::all();
		return View::make('juries.index') -> with('juries', $juries);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//return the creating page
		return View::make('juries.create');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//save the new jury to database
		$jury = new Jury();
		$jury -> FirstName = Input::get('first_name');
		$jury -> LastName = Input::get('last_name');
		$jury -> Email = Input::get('email');
		$jury -> Country = Input::get('country');
		$jury -> save();

		return Redirect::to('juries');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//display a specified jury by id
		$jury = Jury::find($id);
		return View::make('juries.record') -> with('jury', $jury);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//show the form to edit jury details
		$jury = Jury::find($id);
		return View::make('juries.edit') -> with('jury', $jury);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//update jury information
		$jury = Jury::find(Input::get('jury_id'));
		$jury -> FirstName = Input::get('first_name');
		$jury -> LastName = Input::get('last_name');
		$jury -> Email = Input::get('email');
		$jury -> Country = Input::get('country');
		if(null !== Input::get('enabled')){
			$jury -> Enabled = true;
		}else{
			$jury -> Enabled = false;
		}
		$jury -> save();

		return Redirect::to('juries');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//delete the specified jury
		$jury = Jury::find($id) -> delete();
		return Redirect::to('juries');
	}

	/**
	 * Remove multiple selected resource from storage.
	 *
	 * @return Response
	 */
	public function massDelete()
	{
		//remove the array of selected juries from db
		Jury::destroy(Input::get('all-juries'));
		return 'Selected juries have been removed.';
	}


}
