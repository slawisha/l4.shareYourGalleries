<?php

use Petrovic\Repositories\UserRepository as User;
use Petrovic\Validation\ValidationException;

class UsersController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
		$this->beforeFilter('auth',['except'=>['store']]);
		$this->beforeFilter('admin', [ 'only'=> ['index','destroy'] ]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->findOtherUsers([1]);
		return View::make('users.index')->withTitle('Users')->withUsers($users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
		$username = Input::get('username');
		$email = Input::get('email');
		$password = Input::get('password');
		$passwordConfirmation = Input::get('password_confirmation');

		$data = ['username'=>$username, 'email'=>$email,'password'=>$password,'password_confirmation'=>$passwordConfirmation];

		Event::fire('user.saving', [$data]);

		$input = [
			'username' => $username,
			'email' => $email,
			'password' => Hash::make($password),
			'role_id' => 2
		];

		$this->user->save($input);

		return Redirect::route('login')->withFlashMessage('You are now registered. Please log in.');
		}

		catch(ValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
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
	public function destroy($id)
	{
		$this->user->delete($id);
		return Redirect::back()->withFlashMessage('User deleted succesufully');
	}

	public function sharing()
	{
		$users = $this->user->all();
		$userSharesIds = $this->user->userSharesIds(Auth::user()->id);
		return View::make('users.sharing')->withTitle('Sharing')
						->withUsers($users)->with('userSharesIds', $userSharesIds);
	}

}