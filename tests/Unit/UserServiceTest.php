<?php

namespace ColoredCow\LaravelGSuite\Test\Unit;

use ColoredCow\LaravelGSuite\Services\Service;
use Illuminate\Contracts\Container\BindingResolutionException;
use ColoredCow\LaravelGSuite\Services\UserService;
use ColoredCow\LaravelGSuite\Test\TestCase;

class UserServiceTest extends TestCase
{
    protect $service;

    public function setUp() {
        parent::setUp();
        $this->service = app(UserService::class);
    }

	/** @test */
	public function it_will_have_a_initialize_google_client()
	{
        $userService = app(UserService::class);
        $this->assertInstanceOf(\Google_Client::class, $userService->getClient());
    }

    /** @test */
    public function client_will_have_desired_scopes() {
        $userService = app(UserService::class);
        $client = $userService->getClient();
        $this->assertEquals($client->getScopes(), $userService->getSpecificScopes());
    }

    /** @test */
    public function it_will_have_desired_service() {
        $userService = app(UserService::class);
        $this->assertInstanceOf(\Google_Service_Directory::class, $userService->service);
    }
}
