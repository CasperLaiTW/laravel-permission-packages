<?php 
namespace Casper\Permission;

use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('casper/permission');
		if (file_exists($routes_file = $this->app['path'].'/routes.php'))
			require_once $routes_file;
		// Load the app permissions if they're in app/permissions.php
        if (file_exists($file = $this->app['path'].'/permissions.php'))
            require $file;
        $url = \Request::url();
        $this->app['permission']->verify($url);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['permission'] = $this->app->share(function($app){
			$permissions = new Manager();
			return $permissions;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('permission');
	}

}

