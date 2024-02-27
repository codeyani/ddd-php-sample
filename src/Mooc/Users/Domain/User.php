<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Domain;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Shared\Domain\Aggregate\AggregateRoot;

final class User extends AggregateRoot
{
	public function __construct(
		private readonly UserId $id, 
		private UserEmail $email,
		private UserFirstName $firstName,
		private UserLastName $lastName,
	) {}

	public static function create(
		UserId $id,
		UserEmail $email,
		UserFirstName $firstName,
		UserLastName $lastName
	): self
	{
		$user = new self($id, $email, $firstName, $lastName);

		$user->record(new UserCreatedDomainEvent($id->value(), $email->value(), $firstName->value(), $lastName->value()));

		return $user;
	}

	public function id(): UserId
	{
		return $this->id;
	}

	public function email(): UserEmail
	{
		return $this->email;
	}

	public function firstName(): UserFirstName
	{
		return $this->firstName;
	}

	public function lastName(): UserLastName
	{
		return $this->lastName;
	}

	public function rename(UserFirstName $newName): void
	{
		$this->firstName = $newName;
	}
}
