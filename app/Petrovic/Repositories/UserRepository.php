<?php namespace Petrovic\Repositories;

use \User;

class UserRepository {

	public function all()
	{
		return User::all();
	}

	public function findOtherUsers($except)
	{
		return User::whereNotIn('id', $except)->get();
	}

	public function findById($id)
	{
		return User::find($id);
	}

	/**
	 * finds all users usernames that user with $id shares galleries with
	 * @param  int $id user id
	 * @return array   
	 */
	public function userShares($id)
	{
		$user = User::find($id);
		return $user->userShares()->lists('username');
	}

	/**
	 * finds all users id's that user with $id shares galleries with
	 * @param  int $id user id
	 * @return array   
	 */
	public function userSharesIds($id)
	{
		$user = User::find($id);
		return $user->userShares()->lists('user_share_id');
	}

	/**
	 * find galleries of sharing users
	 * @param  array  $userIds 
	 * @return array of galleries collection
	 */
	public function findUserShareGalleries(array $userIds)
	{
		$userShareGalleries = [];

		foreach ($userIds as $userId)
		{
				
			$user = User::with('galleries')->find($userId);

			if( !$user->galleries->isEmpty() )

			$userShareGalleries[] = [[$user->username, $user->id], $user->galleries];
		}

		return $userShareGalleries;
	}

	public function findUsersGalleries($userId)
	{
		return User::with('galleries')->find($userId)->galleries;
	}

	public function save($input)
	{
		$gallery = new User;

		foreach ($input as $key => $value) {
			$gallery->$key = $value;
		}

		$gallery->save();

	}

	public function delete($id)
	{
		User::find($id)->delete() ;
	}
}