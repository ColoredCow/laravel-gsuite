<?php

namespace ColoredCow\LaravelGSuite\Test\Unit;

use ColoredCow\LaravelGSuite\Services\Service;
use Illuminate\Contracts\Container\BindingResolutionException;
use ColoredCow\LaravelGSuite\Services\UserService;
use ColoredCow\LaravelGSuite\Test\TestCase;

class UserServiceTest extends TestCase
{
    protected $service;

    public function setUp() {
        parent::setUp();
        $this->service = app(UserService::class);
    }

    /** @test */
    public function client_will_have_desired_scopes() {
        $client = $this->service->getClient();
        $this->assertEquals($client->getScopes(), $this->service->getServiceSpecificScopes());
    }

    /** @test */
    public function it_will_have_desired_service()
    {
        $this->assertInstanceOf(\Google_Service_Directory::class, $this->service->service);
    }
}
