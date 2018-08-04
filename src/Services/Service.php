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
		if (config('gsuite.multitenancy')) {
			$gsuiteConfigurations = app(config('gsuite.models.tenant.gsuite-configurations'));
			$impersonateUser = $gsuiteConfigurations->getServiceAccountImpersonate();
		} else {
			$impersonateUser = config('gsuite.service-account-impersonate');
		}
		$this->client->setSubject($impersonateUser);
	}
}
