<?php

namespace ColoredCow\LaravelGSuite\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use ColoredCow\LaravelGSuite\Contracts\Tenant\GSuiteConfiguration as GSuiteConfigurationContract;

class GSuiteConfiguration extends Model implements GSuiteConfigurationContract
{
	protected $guarded = ['id'];

	public function __construct()
	{
		$this->setTable(config('gsuite.tables.tenant.gsuite-configuration'));
		$this->setConnection(config('gsuite.connections.tenant'));
	}

	public function getApplicationCredentials(): string
	{
		return $this->getByKey(config('gsuite.keys.tenant.application-credentials'));
	}

	public function getServiceAccountImpersonate(): string
	{
		return $this->getByKey(config('gsuite.keys.tenant.service-account-impersonate'));
	}

	public function getByKey(string $key): string
	{
		return self::where('key', $key)->first()->value;
	}
}
