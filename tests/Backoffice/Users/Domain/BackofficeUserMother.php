<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Users\Domain;

use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Tests\Mooc\Users\Domain\UserEmailMother;
use Codeyani\Tests\Mooc\Users\Domain\UserFirstNameMother;
use Codeyani\Tests\Mooc\Users\Domain\UserIdMother;
use Codeyani\Tests\Mooc\Users\Domain\UserLastNameMother;

final class BackofficeUserMother
{
	public static function create(
		?string $id = null,
		?string $email = null,
		?string $firstName = null,
		?string $lastName = null
		): BackofficeUser
	{
		return new BackofficeUser(
			$id ?? UserIdMother::create()->value(),
			$email ?? UserEmailMother::create()->value(),
			$firstName ?? UserFirstNameMother::create()->value(),
			$lastName ?? UserLastNameMother::create()->value()
		);
	}
}
