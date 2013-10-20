<?php 
namespace Casper\Permission;

class Manager
{
	protected $permissions = array();



	public function setPermission($route, $permissions)
	{
		$permissions = !is_array($permissions) ? array($permissions) : $permissions;
		$this->permissions[$route]	= $permissions;
	}

	public function getPermission($route)
	{
		if(array_key_exists($route, $this->permissions))
			return $this->permissions[$route];
		else
			return NULL;
	}

	public function verify()
	{
		$url = \Request::url();
		$permissions = $this->getPermission($url);
		//Super Admin is Uncontrolled (All Permission)
		if(!\Auth::user()->can($permissions)) throw new UserCanNotUseException('User Can\'t use this.');

	}
}

class UserCanNotUseException extends \Exception{}