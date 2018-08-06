<?php

namespace ColoredCow\LaravelGSuite\Test;

use ColoredCow\LaravelGSuite\Services\Service;
use Illuminate\Contracts\Container\BindingResolutionException;

class ServiceTest extends TestCase
{

	/** @test */
	public function a_stand_alone_service_can_not_be_initialize()
	{
        $this->expectException(BindingResolutionException::class);
        $serviceClass = app(Service::class);
    }
}
