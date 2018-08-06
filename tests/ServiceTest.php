<?php

namespace ColoredCow\LaravelGSuite\Test;

use ColoredCow\LaravelGSuite\Services\Service;
use Illuminate\Contracts\Container\BindingResolutionException;

class ServiceTest extends TestCase
{
	/** @test */
	public function a_service_can_not_be_initialize_alone()
	{
        $this->expectException(BindingResolutionException::class);
        $serviceClass = app(Service::class);
	}
}
