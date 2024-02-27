<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Tests\Shared\Domain\WordMother;

final class UserFirstNameMother
{
	public static function create(?string $value = null): UserFirstName
	{
		return new UserFirstName($value ?? WordMother::create());
	}
}
