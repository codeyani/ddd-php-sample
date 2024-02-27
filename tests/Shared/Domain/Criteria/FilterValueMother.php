<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Domain\Criteria;

use Codeyani\Shared\Domain\Criteria\FilterValue;
use Codeyani\Tests\Shared\Domain\WordMother;

final class FilterValueMother
{
	public static function create(?string $value = null): FilterValue
	{
		return new FilterValue($value ?? WordMother::create());
	}
}
