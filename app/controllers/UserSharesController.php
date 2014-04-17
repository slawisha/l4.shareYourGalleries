<?php

use Petrovic\Repositories\UserRepository as User;
use Petrovic\Repositories\UserShareRepository as UserShare;

class UserSharesController extends \BaseController {

	protected $user;
	protected $userShare;

	public function __construct(User $user, UserShare $userShare )
	{
		$this->user = $user;
		$this->userShare = $userShare;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($userId)
	{
		$users = $this->user->findOtherUsers([1, Auth::user()->id]);
		$userSharesIds = $this->user->userSharesIds($userId);
		return View::make('sharings.index')->withTitle('Sharing')
						->withUsers($users)->with('userSharesIds', $userSharesIds);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($userShareId)
	{
		$this->userShare->save(Auth::user()->id, $userShareId);
		return Redirect::back();
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
	public function destroy($userId, $userShareId)
	{
		$this->userShare->delete($userId, $userShareId);
		return Redirect::back();
	}

}