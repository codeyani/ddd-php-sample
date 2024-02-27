<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Users\Domain\UserLastName;
use Codeyani\Tests\Shared\Domain\WordMother;

final class UserLastNameMother
{
	public static function create(?string $value = null): UserLastName
	{
		return new UserLastName($value ?? WordMother::create());
	}
}
