<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application;

final readonly class BackofficeUserResponse
{
	public function __construct(
		private string $id,
		private string $email,
		private string $firstName,
		private string $lastName,
	) {}

	public function id(): string
	{
		return $this->id;
	}

	public function email(): string
	{
		return $this->email;
	}

	public function firstName(): string
	{
		return $this->firstName;
	}

	public function lastName(): string
	{
		return $this->lastName;
	}
}
