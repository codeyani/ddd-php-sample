<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

use Codeyani\Shared\Domain\Collection;

final class Videos extends Collection
{
	protected function type(): string
	{
		return Video::class;
	}
}
