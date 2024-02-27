<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Find;

use Codeyani\Shared\Domain\Bus\Query\Query;

final readonly class FindVideoQuery implements Query
{
	public function __construct(private string $id) {}

	public function id(): string
	{
		return $this->id;
	}
}
