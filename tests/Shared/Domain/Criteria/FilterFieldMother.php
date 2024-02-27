<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Domain\Criteria;

use Codeyani\Shared\Domain\Criteria\FilterField;
use Codeyani\Tests\Shared\Domain\WordMother;

final class FilterFieldMother
{
	public static function create(?string $fieldName = null): FilterField
	{
		return new FilterField($fieldName ?? WordMother::create());
	}
}
