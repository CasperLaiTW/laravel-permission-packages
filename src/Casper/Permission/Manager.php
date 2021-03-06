<?php 
namespace Casper\Permission;

class Manager
{
	protected $permissions = array();



	public function setPermission($routes, $permissions)
	{		
		$routes = !is_array($routes) ? array($routes) : $routes;
		$permissions = !is_array($permissions) ? array($permissions) : $permissions;
		
		foreach($routes as $route)
		{
			$this->permissions[$route]	= $permissions;
		}
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
		$route = \Route::currentRouteName();
		$permissions = $this->getPermission($route);
		//Super Admin is Uncontrolled (All Permission)
		if(!\Auth::user()->can($permissions)) throw new UserCanNotUseException('User Can\'t use this.');

	}
}

class UserCanNotUseException extends \Exception{}