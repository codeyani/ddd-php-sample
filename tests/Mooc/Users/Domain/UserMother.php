<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Users\Application\Create\CreateUserCommand;
use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Mooc\Users\Domain\UserLastName;

final class UserMother
{
	public static function create(
		?UserId $id = null,
		?UserEmail $email = null,
		?UserFirstName $firstName = null,
		?UserLastName $lastName = null
	): User {
		return new User(
			$id ?? UserIdMother::create(),
			$email ?? UserEmailMother::create(),
			$firstName ?? UserFirstNameMother::create(),
			$lastName ?? UserLastNameMother::create(),
		);
	}

	public static function fromRequest(CreateUserCommand $request): User
	{
		return self::create(
			UserIdMother::create($request->id()),
			UserEmailMother::create($request->email()),
			UserFirstNameMother::create($request->firstName()),
			UserLastNameMother::create($request->lastName()),
		);
	}
}
