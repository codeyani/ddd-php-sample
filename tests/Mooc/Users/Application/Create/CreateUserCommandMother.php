<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Application\Create;

use Codeyani\Mooc\Users\Application\Create\CreateUserCommand;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Mooc\Users\Domain\UserLastName;
use Codeyani\Tests\Mooc\Users\Domain\UserEmailMother;
use Codeyani\Tests\Mooc\Users\Domain\UserFirstNameMother;
use Codeyani\Tests\Mooc\Users\Domain\UserIdMother;
use Codeyani\Tests\Mooc\Users\Domain\UserLastNameMother;

final class CreateUserCommandMother
{
	public static function create(
		?UserId $id = null,
		?UserEmail $email = null,
		?UserFirstName $firstName = null,
		?UserLastName $lastName = null,
	): CreateUserCommand {
		return new CreateUserCommand(
			$id?->value() ?? UserIdMother::create()->value(),
			$email?->value() ?? UserEmailMother::create()->value(),
			$firstName?->value() ?? UserFirstNameMother::create()->value(),
			$lastName?->value() ?? UserLastNameMother::create()->value(),
		);
	}
}
