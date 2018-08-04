<?php

namespace ColoredCow\LaravelGSuite\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use ColoredCow\LaravelGSuite\Contracts\GSuiteConfiguration as GSuiteConfigurationContract;

class GSuiteConfiguration extends Model implements GSuiteConfigurationContract
{
	protected $guarded = ['id'];

	public function __construct()
	{
		$this->setTable(config('gsuite.tables.tenant.gsuite-configurations.name'));
	}

	public function getApplicationCredentials()
	{
		return self::where('key', config('gsuite.tables.tenant.gsuite-configurations.keys.application-credentials'));
	}

	public function getServiceAccountImpersonate()
	{
		return self::where('key', config('gsuite.tables.tenant.gsuite-configurations.keys.service-account-impersonate'));
	}
}
