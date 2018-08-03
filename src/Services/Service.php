<?php

namespace ColoredCow\LaravelGSuite\Services;

use Google_Client;

abstract class Service
{
	protected $client;

	public function __construct()
	{
		$this->client = new Google_Client();
		$this->client->useApplicationDefaultCredentials();
		if (config('laravel-gsuite.multitenancy')) {
			$impersonateUser = config('laravel-gsuite.service-account-impersonate');
		} else {
			$impersonateUser = config('laravel-gsuite.service-account-impersonate');
		}
		$this->client->setSubject($impersonateUser);
	}
}
