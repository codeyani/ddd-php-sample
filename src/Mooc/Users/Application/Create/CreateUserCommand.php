<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Application\Create;

use Codeyani\Shared\Domain\Bus\Command\Command;

final readonly class CreateUserCommand implements Command
{
	public function __construct(
		private string $id,
		private string $email,
		private string $firstName,
		private string $lastName
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
