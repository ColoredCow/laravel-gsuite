<?php

namespace ColoredCow\LaravelGSuite\Facades;

use ColoredCow\LaravelGSuite\Services\UserService;
use Illuminate\Support\Facades\Facade;

class GSuiteUserService extends Facade
{
	protected static function getFacadeAccessor()
	{
		return UserService::class;
	}
}
