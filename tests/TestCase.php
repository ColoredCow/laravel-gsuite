<?php

namespace ColoredCow\LaravelGSuite\Test;

use ColoredCow\LaravelGSuite\Providers\GSuiteServiceProvider;
use ColoredCow\LaravelGSuite\Facades\GSuiteUserService;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
	/**
	 * Load package service provider
	 * @param  \Illuminate\Foundation\Application $app
	 * @return lasselehtinen\MyPackage\MyPackageServiceProvider
	 */
	protected function getPackageProviders($app)
	{
		return [
			GSuiteServiceProvider::class,
		];
	}

	/**
	 * Load package alias
	 * @param  \Illuminate\Foundation\Application $app
	 * @return array
	 */
	protected function getPackageAliases($app)
	{
		return [
			'GSuiteUserService' => GSuiteUserService::class,
		];
	}

	/**
	 * Set up the environment.
	 *
	 * @param \Illuminate\Foundation\Application $app
	 */
	protected function getEnvironmentSetUp($app)
	{
		$app['config']->set('database.default', 'testbench');
		$app['config']->set('database.connections.testbench', [
			'driver' => 'sqlite',
			'database' => ':memory:',
			'prefix' => '',
		]);
	}
}
