<?php

namespace ColoredCow\LaravelGSuite\Services;

use Carbon\Carbon;

class UserService extends Service
{
	protected $name;
	protected $joinedOn;
	protected $designation;


	public function fetch($email)
	{
		$user = $this->service->users->get($email);
		$userOrganizations = $user->getOrganizations();

		$designation = null;
		if (!is_null($userOrganizations)) {
			$designation = $userOrganizations[0]['title'];
		}
		$this->setName($user->getName()->fullName);
		$this->setJoinedOn(Carbon::parse($user->getCreationTime())->format('Y-m-d H:i:s'));
		$this->setDesignation($designation);

		return $this;
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

	public function getSpecificScopes() {
		return[
			\Google_Service_Directory::ADMIN_DIRECTORY_USER,
			\Google_Service_Directory::ADMIN_DIRECTORY_USER_READONLY,
		];
	}
}
