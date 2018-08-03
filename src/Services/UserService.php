<?php

namespace ColoredCow\LaravelGSuite\Services;

use Carbon\Carbon;
use Google_Service_Directory;

class UserService extends Service
{
	protected $name;
	protected $joinedOn;
	protected $designation;
	protected $service;

	public function __construct()
	{
		parent::__construct();

		$this->client->addScope([
			Google_Service_Directory::ADMIN_DIRECTORY_USER,
			Google_Service_Directory::ADMIN_DIRECTORY_USER_READONLY,
		]);

		$this->service = new Google_Service_Directory($this->client);
	}

	public function fetch($email)
	{
		$user = $this->service->users->get($email);
		$userOrganizations = $user->getOrganizations();

		$designation = null;
		if (!is_null($userOrganizations)) {
			$designation = $userOrganizations[0]['title'];
		}
		$this->setName($user->getName()->fullName);
		$this->setJoinedOn(Carbon::parse($user->getCreationTime())->format(config('constants.date_format')));
		$this->setDesignation($designation);
	}

	public function setJoinedOn($joinedOn)
	{
		$this->joinedOn = $joinedOn;
	}

	public function getJoinedOn()
	{
		return $this->joinedOn;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setDesignation($designation)
	{
		$this->designation = $designation;
	}

	public function getDesignation()
	{
		return $this->designation;
	}
}
