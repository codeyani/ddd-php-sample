<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Domain;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Tests\Shared\Domain\UuidMother;

final class UserIdMother
{
	public static function create(?string $value = null): UserId
	{
		return new UserId($value ?? UuidMother::create());
	}
}
