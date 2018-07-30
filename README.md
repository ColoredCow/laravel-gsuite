# Laravel GSuite
A Laravel package to setup your Google OAuth and GSuite Admin SDK.

## Installation steps
Download the repository from your command line
```console
$ composer require coloredcow/laravel-gsuite
```

Run the migrations
```console
$ php artisan migrate
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

Inside your `app/Http/Controllers/Auth/LoginController.php`, use the package trait `CreatesLogin`
```php

<?php

use ColoredCow\LaravelGSuite\Traits\CreatesLogin;

class LoginController extends Controller
{
...

use AuthenticatesUsers, CreatesLogin;
...
```

That's it! Go to `your_app_url/auth/google` and use your Google email to login.
