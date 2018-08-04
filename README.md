# Laravel GSuite
A Laravel package to setup Google OAuth and GSuite Admin SDK.

## Installation
You can install the package using composer
```
composer require coloredcow/laravel-gsuite
```

Publish the configurations
```
php artisan vendor:publish --provider="ColoredCow\LaravelGSuite\Providers\GSuiteServiceProvider" --tag="config"
```

## Setting up Google Oauth
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

Inside your `app/Http/Controllers/Auth/LoginController.php`, use the package trait `GSuiteLogin`
```php
<?php

use ColoredCow\LaravelGSuite\Traits\GSuiteLogin;

class LoginController extends Controller
{

    use AuthenticatesUsers, GSuiteLogin;

    // ...
```

That's it! Go to `your_app_url/auth/google` and use your Google email to login.

## Setting up GSuite Admin Service
In your `.env` file, add the following credentials:
```
GOOGLE_APPLICATION_CREDENTIALS=your_gsuite_service_account_crendentials
GOOGLE_SERVICE_ACCOUNT_IMPERSONATE=your_gsuite_admin_email
```
To know more about service account and steps to get one, visit [the official Google Documentation](https://developers.google.com/identity/protocols/OAuth2ServiceAccount).

**NOTE:** Make sure you enable `Domain-wide Delegation` when creating the service account for your project.

You can now use various services provided by the package. For example, if you want to fetch a user details, you can use the `GSuiteUserService` facade.
```php
use ColoredCow\LaravelGSuite\Facades\GSuiteUserService;

// ...

$user = GSuiteUserService::fetch('jon@mycompany.com');

echo $user->getName(); // Jon Snow
echo $user->getJoinedOn(); // 2016-12-26 12:15:00
echo $user->getDesignation(); // Lord Commander
```

## Enabling multitenancy
There are some additional steps required in case your application supports multitenancy.

Set multitenancy to **true** in your `config/gsuite.php`
```php
'multitenancy' => true,
```

The default value for tenant connection is `tenant`. If you're using a different name for tenant connection, update `config/gsuite.php`
```php
'connections' => [
    'tenant' => 'tenant_connection',
]
```

Since you'll have multiple tenants, and you may need different GSuite API credentials for each of them, the package will create a table in each tenant database. This table will store the required gsuite credentials.

Publish the tenant specific migrations using the following command. This will publish the migrations into `database/migrations/tenant` directory.
```
php artisan vendor:publish --provider="ColoredCow\LaravelGSuite\Providers\GSuiteServiceProvider" --tag="multitenancy"
```
Now, create your tenant databases.

**NOTE:** If you already have existing tenants, you may need to recreate those tenant databases. You may lose some data if not done carefully.

In every tenant database, you need to define the application credentials and service account impersonate user. You can add a seeder to your multitenancy implementation so that it runs everytime a new tenant database is created.

Your `gsuite_configurations` table should look this
|id|key|value|created_at|updated_at|
|-|-|-|-|-|
|1|application_credentials|full_path_to_credentials.json|2018-06-06 16:00:00|2018-06-06 16:00:00|
|2|application_credentials|admin@mycompany.com|2018-06-06 16:00:00|2018-06-06 16:00:00|

### More multitenancy configurations
If you prefer to have a different name for the `gsuite_configurations` table, update `config/gsuite.php`
```php
'tables' => [
    'tenant' => [
        'gsuite-configurations' => 'your_gsuite_table_name',
    ]
]
```

If you prefer to override the package's `GSuiteConfiguration` model, create a custom model that must implement the `ColoredCow\LaravelGSuite\Contracts\Tenant\GSuiteConfiguration` contract. Then, update your `config/gsuite.php` and replace the default model with the new model.
```php
'models' => [
    'tenant' => [
        'gsuite-configuration' => App\YourModelName::class
    ]
]
```
