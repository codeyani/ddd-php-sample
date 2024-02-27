<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Domain;

use Codeyani\Shared\Domain\Aggregate\AggregateRoot;

final class BackofficeUser extends AggregateRoot
{
	public function __construct(
		private readonly string $id,
		private readonly string $email,
		private readonly string $firstName,
		private readonly string $lastName
	) {}

	public static function fromPrimitives(array $primitives): self
	{
		return new self($primitives['id'], $primitives['email'], $primitives['firstName'], $primitives['lastName']);
	}

	public function toPrimitives(): array
	{
		return [
			'id' => $this->id,
			'email' => $this->email,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName
		];
	}

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
