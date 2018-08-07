<?php

namespace ColoredCow\LaravelGSuite\Services;

use Google_Client;
use Google_Service_Directory;

abstract class Service
{
    protected $client;
    public $service;

    /**
     * Get scopes required for the service to make the API calls.
     *
     * @return array
     */
    abstract public function getServiceSpecificScopes(): array;

    /**
     * Sets the service instance for the Google Service in use.
     *
     * @return void
     */
    abstract public function setService();

    public function __construct()
    {
        $this->setClient();
        $this->setService();
    }

    protected function setClient() {
        $this->client = new Google_Client();
        $this->client->useApplicationDefaultCredentials();
        $this->client->setSubject($this->getImpersonateUser());
        $this->client->addScope($this->getServiceSpecificScopes());
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getImpersonateUser()
    {
        if(!config('gsuite.multitenancy')) {
            return config('gsuite.service-account-impersonate');
        }

        $gsuiteConfigurations = app(config('gsuite.models.tenant.gsuite-configuration'));
        return $gsuiteConfigurations->getServiceAccountImpersonate();
    }
}
