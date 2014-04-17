<?php

use Petrovic\Validation\ValidationException;

class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if( is_admin() ) return Redirect::route('admin.index')
					->withFlashMessage('Welcome ' . Auth::user()->username);

		if(Auth::check()) return Redirect::route('members.index');

		return View::make('sessions.create')->withTitle('Login page');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
			if ( Auth::attempt(Input::only('email','password')) )
			{
				if( is_admin() ) return Redirect::route('admin.index')
					->withFlashMessage('Welcome ' . Auth::user()->username);
				return Redirect::route('members.index')->withFlashMessage('Welcome ' . Auth::user()->username);
			} 
			else
			{
				return Redirect::back()->withInput()->withFlashMessage('Invalid credentials');
			}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::route('home');
	}

}