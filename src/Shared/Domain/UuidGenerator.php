<?php

declare(strict_types=1);

namespace Codeyani\Shared\Domain;

interface UuidGenerator
{
	public function generate(): string;
}
