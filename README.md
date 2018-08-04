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

...

use AuthenticatesUsers, GSuiteLogin;

...
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

## Enabling multitenancy
There are some additional steps required in case your application supports multitenancy.

Set multitenancy to **true** in your `config/gsuite.php`
```php
'multitenancy' => true,
```

Since you'll have multiple tenants, and you may need different GSuite API credentials for each of them, the package will store the credentials in a table and will fetch from the table itself instead of reading from the `.env` file.
For this, you need to publish the multitenancy migrations
```
php artisan vendor:publish --provider="ColoredCow\LaravelGSuite\Providers\GSuiteServiceProvider" --tag="multitenancy"
```

Next, add the `ColoredCow\LaravelGSuite\Traits\HasGSuiteConfigurations` trait in your tenant model
```php
use ColoredCow\LaravelGSuite\Traits\HasGSuiteConfigurations;

class Tenant extends Model
{
    use HasGSuiteConfigurations;

    // ...
```

You will be now able to map your tenant and it's GSuite configurations. For example, if you have a tenant instance, you can create/update/delete the gsuite configurations using:
```php
$tenant->gsuiteConfigurations;
```
A sample output would be:
```php
[
    'id' => 20,
    'tenant_id' => 20, // the column name may change based on values set in config/gsuite.php
    'application_credentials' => '2018/04/tenant-credentials.json',
    'service_account_impersonate' => 'admin@tenant.com',
    'created_at' => '2018-08-04 16:00:00',
    'modified_at' => '2018-08-04 16:00:00'
]
```
### More multitenancy configurations
If you prefer to have a different name for the `gsuite_configurations` table and maybe for the `tenant_id` column in the table, you can configure these values in `config/gsuite.php`
```php
'tables' => [
    'tenant' => [
        'gsuite-configurations' => [
            'name' => 'your_table_name',
            'columns' => [
                'tenant-id' => 'your_column_name'
            ]
        ]
    ]
]
```
If you prefer to override the package's `GSuiteConfiguration` model, you can create a custom model that must extend the `ColoredCow\LaravelGSuite\Models\GSuiteConfiguration` model. Then, update your `config/gsuite.php` and replace the default model with the new model.
```php
'models' => [
    'tenant' => [
        'gsuite-configurations' => App\YourModelName::class
    ]
]
```
