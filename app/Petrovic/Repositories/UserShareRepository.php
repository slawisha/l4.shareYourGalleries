<?php namespace Petrovic\Repositories;

use \UserShare;

class UserShareRepository{

	public function save($userId, $userShareId)
	{
		$userShare = new UserShare;
		$userShare->user_id = $userId;
		$userShare->user_share_id = $userShareId;
		$userShare->save();
	}

	public function delete($userId, $userShareId)
	{
		$userShare = UserShare::where('user_id','=', $userId)->where('user_share_id','=',$userShareId)->delete();
	}

	/**
	 * find ids of all users that share gallery with user with $id
	 * @param  int $id 
	 * @return ELoquent collection     [description]
	 */
	public function sharingIds($id)
	{
		return UserShare::where('user_share_id', $id)->lists('user_id');		
	}
}