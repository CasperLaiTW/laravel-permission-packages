# Easy Permission Verify - Laravel 4 

---
It's a extend toddish verify permission to easy setting for Laravel 4.
---

* a file organize all permission defined
* Licensed under the MIT license

---

## Important

This packages depends on **toddish/veirfy**. You should configurate **toddish/verify**.

## Installation


Add verify to your composer.json file:

```
"require": {
	"casper/permission": "2.1.*"
}
```

Now, run a composer update on the command line from the root of your project:

    composer update

### Registering the Package

Add the service provider to your config in ``app/config/app.php``:

```php
'providers' => array(
	'Casper\Permission\PermissionServiceProvider'
),
```

### Set Package Aliases

Add the service Aliases to your config in ``app/config/app.php``:

```php
'aliases' => array(
	'Permission'      => 'Casper\Permission\PermissionFacade'
),
```

### Usage
#### 1. Define permissions in `app/permission.php`
Now, create a file called `app/permission.php`. The file will be loaded automatically.



```php
// Permission::setPermission($route, $canUsePermissionName);
Permission::setPermission(route('admin.roles.index'), array('role_index', 'role_all'));
```

As you can see, the define include two param:

* `$route` It's your page url
* `$canUsePermissionName` It's means can use this page's permission name. It's can be array, or string.

#### 2. Run Verify
In you want to run verify place to add code:
```php
	Permission::verify(Request::url());
```
Example: 
I want to verify after checking admin logged-in. So I place code in `app/filters.php`
```php
Route::filter('auth.admin', function(){
	if(Auth::guest()) return Redirect::route('admin.login');
	// Permission Verify
	Permission::verify();
});
```



