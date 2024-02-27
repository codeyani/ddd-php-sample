<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Auth\Domain;

use Codeyani\Shared\Domain\ValueObject\StringValueObject;

final class AuthPassword extends StringValueObject
{
	public function isEquals(self $other): bool
	{
		return $this->value() === $other->value();
	}
}
