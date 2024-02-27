<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Users\Domain\UserCreatedDomainEvent;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Mooc\Users\Domain\UserLastName;

final class UserCreatedDomainEventMother
{
	public static function create(
		?UserId $id = null,
		?UserEmail $email = null,
		?UserFirstName $firstName = null,
		?UserLastName $lastName = null,
	): UserCreatedDomainEvent {
		return new UserCreatedDomainEvent(
			$id?->value() ?? UserIdMother::create()->value(),
			$email?->value() ?? UserEmailMother::create()->value(),
			$firstName?->value() ?? UserFirstNameMother::create()->value(),
			$lastName?->value() ?? UserLastNameMother::create()->value(),
		);
	}

	public static function fromUser(User $user): UserCreatedDomainEvent
	{
		return self::create(
			$user->id(),
			$user->email(),
			$user->firstName(),
			$user->lastName(),
		);
	}
}
