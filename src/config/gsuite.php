<?php

return [
	/**
	 * When using the GSuite API services, we need to know the application credentials for your domain.
	 * This is the service account file that you need to get from your Google Developer Console.
	 *
	 * Laravel-GSuite package utilizes domain wide delegation. Make sure you enable that at the time of file creation.
	 */
	'application-credentials' => env('GOOGLE_APPLICATION_CREDENTIALS'),
	
	
	/**
	 * This will used to porovide access to only gsuite User with a specific domain.
	 */

	'hd' => env('GOOGLE_CLIENT_HD', ''),

	/**
	 * This must be the super-admin account of your GSuite organization.
	 * Laravel-GSuite will act on behalf of this user to perform all the API actions.
	 */
	'service-account-impersonate' => env('GOOGLE_SERVICE_ACCOUNT_IMPERSONATE'),

	/**
	 * By setting the below value to true, Laravel GSuite package will read the application-credentials
	 * and service-account-impersonate values from the tenant databases.
	 */
	'multitenancy' => false,

	'models' => [
		'tenant' => [
			/**
			 * When retrieving gsuite configurations for a tenant, we need to know which Eloquent model we should use.
			 * You can override the default functionality by creating your own Eloquent model that deals with
			 * storing the gsuite configurations.
			 *
			 * Your custom model must implement the \ColoredCow\LaravelGSuite\Contracts\GSuiteConfiguration
			 */
			'gsuite-configuration' => ColoredCow\LaravelGSuite\Models\Tenant\GSuiteConfiguration::class,
		]
	],

	'connections' => [
		/**
		 * While storing/retrieving gsuite credentials, we need to know which database connection the tenant is using.
		 * If you're using a multi-tenancy package or have your custom multi-tenancy implementation,
		 * this value should match with your tenant connection name.
		 */
		'tenant' => 'tenant',
	],

	'tables' => [
		'tenant' => [
			/**
			 * We'll look for the gsuite credentials for a tenant in the below table. You can
			 * change the table name as per your application needs.
			 */
			'gsuite-configurations' => 'gsuite_configurations',
		]
	],

	'keys' => [
		'tenant' => [
			'application-credentials' => 'application_credentials',
			'service-account-impersonate' => 'service_account_impersonate',
		]
	]
];
