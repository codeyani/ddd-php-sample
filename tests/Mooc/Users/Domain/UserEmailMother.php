<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Tests\Shared\Domain\WordMother;

final class UserEmailMother
{
	public static function create(?string $value = null): UserEmail
	{
		return new UserEmail($value ?? WordMother::create());
	}
}
