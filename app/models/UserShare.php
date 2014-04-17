<?php

class UserShare extends \Eloquent {

	protected $table = 'user_shares';

    protected $fillable = ['user_id','user_share_id'];

    public function user()
	{
		return $this->belongsToMany('UserShares','user_shares','user_share_id','user_id');
	}
}