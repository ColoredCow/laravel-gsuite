<?php

namespace ColoredCow\LaravelGSuite\Traits;

trait HasGSuiteConfigurations
{
	public function gsuiteConfigurations()
	{
		return $this->hasOne(
			config('gsuite.models.tenant.gsuite-configurations'),
			config('gsuite.tables.tenant.gsuite-configurations.columns.tenant-id')
		);
	}
}
