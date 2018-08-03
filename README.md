# Laravel GSuite
A Laravel package to setup Google OAuth and GSuite Admin SDK.

## Installation
You can install the package using composer
```
composer require coloredcow/laravel-gsuite
```

Publish the configurations
```
php artisan vendor:publish --provider="ColoredCow\LaravelGSuite\Providers\LaravelGSuiteServiceProvider"
```

Update the mass-assignable property `$fillable` in your User Model and append the array with the `avatar`. This field will store the user avatar that is fetched from google. Your property should look something like
```php
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];
```
**NOTE:** If you have `$guarded` property instead of `$fillable`, no need to do the above step.

**NOTE:** In case you prefer to have a different name for avatar, you can update it's value from `config/laravel-gsuite.php`.

Run the migrations
```
php artisan migrate
```

Update your .env file with the Google OAuth 2.0 credentials
```
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_CLIENT_CALLBACK=your_google_callback_url
```

**NOTE:** If you wish to restrict users to your organization's domain, add to your .env
```
GOOGLE_CLIENT_HD=your_domain
```

Inside your `app/Http/Controllers/Auth/LoginController.php`, use the package trait `LaravelGSuiteLogin`
```php
<?php

use ColoredCow\LaravelGSuite\Traits\LaravelGSuiteLogin;

class LoginController extends Controller
{

...

use AuthenticatesUsers, LaravelGSuiteLogin;

...
```

That's it! Go to `your_app_url/auth/google` and use your Google email to login.
