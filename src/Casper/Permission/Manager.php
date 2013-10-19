<?php 
namespace Casper\Permission;

class Manager
{
	protected $permissions = array();



	public function setPermission($route, $permissions = array())
	{
		$this->permissions[$route]	= $permissions;
	}

	public function getPermission($route)
	{
		if(array_key_exists($route, $this->permissions))
			return $this->permissions[$route];
		else
			return NULL;
	}

	public function verify($route)
	{
		$permissions = $this->getPermission($route);
		//Super Admin is Uncontrolled (All Permission)
		if(!\Auth::user()->can($permissions)) throw new UserCanNotUseException('User Can\'t use this.');

	}
}

class UserCanNotUseException extends \Exception{}