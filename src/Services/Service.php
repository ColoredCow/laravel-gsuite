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

		$impersonateUser = config('gsuite.service-account-impersonate');
		if (config('gsuite.multitenancy')) {
			$gsuiteConfigurations = app(config('gsuite.models.tenant.gsuite-configuration'));
			$impersonateUser = $gsuiteConfigurations->getServiceAccountImpersonate();
		}
		$this->client->setSubject($impersonateUser);
	}
}
