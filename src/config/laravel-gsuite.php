<?php

return [
	'tables' => [
		'users' => [
			/**
			 * When storing a user avatar, we need to know what column in the users table should
			 * capture it. The default column name is "avatar" but you may easily change
			 * it to anything you prefer.
			 */
			'avatar' => 'avatar',
		]
	],

	/**
	 * When using the GSuite API services, we need to know the application
	 * credentials for your domain. This is basically the service account
	 * file that you need to get from your Google Developer Console.
	 *
	 * Laravel-GSuite package utilizes domain wide delegation. Make sure you enable that at the time of file creation.
	 */
	'application-credentials' => env('GOOGLE_APPLICATION_CREDENTIALS'),

	/**
	 * This must be the super-admin account of your GSuite organization.
	 * Laravel-GSuite will act on behalf of this user to perform all the API actions.
	 */
	'service-account-impersonate' => env('GOOGLE_SERVICE_ACCOUNT_IMPERSONATE'),

	/**
	 * By setting this mode to true, Laravel GSuite package will read the application-credentials
	 * and service-account-impersonate values from the tenant databases.
	 */
	'multitenancy' => false,
];
