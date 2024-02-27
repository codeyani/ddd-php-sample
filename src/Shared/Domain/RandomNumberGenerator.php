<?php

declare(strict_types=1);

namespace Codeyani\Shared\Domain;

interface RandomNumberGenerator
{
	public function generate(): int;
}
