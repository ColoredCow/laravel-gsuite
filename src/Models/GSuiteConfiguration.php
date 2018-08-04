<?php

namespace ColoredCow\LaravelGSuite\Models;

use Illuminate\Database\Eloquent\Model;
use ColoredCow\LaravelGSuite\Contracts\GSuiteConfiguration as GSuiteConfigurationContract;

class GSuiteConfiguration extends Model implements GSuiteConfigurationContract
{
	protected $guarded = ['id'];

	public function __construct()
	{
		$this->setTable(config('gsuite.tables.tenant.gsuite-configurations.name'));
	}
}
