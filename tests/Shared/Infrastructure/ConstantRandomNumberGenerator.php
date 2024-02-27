<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Infrastructure;

use Codeyani\Shared\Domain\RandomNumberGenerator;

final class ConstantRandomNumberGenerator implements RandomNumberGenerator
{
	public function generate(): int
	{
		return 1;
	}
}
