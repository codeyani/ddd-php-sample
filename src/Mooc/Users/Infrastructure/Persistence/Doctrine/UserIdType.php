<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Infrastructure\Persistence\Doctrine;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class UserIdType extends UuidType
{
	protected function typeClassName(): string
	{
		return UserId::class;
	}
}
