<?php

namespace ColoredCow\LaravelGSuite\Contracts\Tenant;

interface GSuiteConfiguration
{
	/**
	 * Retrieve application credentials for the tenant.
	 *
	 * @return string
	 */
	public function getApplicationCredentials(): string;

	/**
	 * Retrieve gsuite user being impersonated by the service account.
	 *
	 * @return string
	 */
	public function getServiceAccountImpersonate(): string;

	/**
	 * Retrieve a gsuite configuration by its key.
	 *
	 * @param string $key
	 * @return string
	 */
	public function getByKey(string $key): string;
}
