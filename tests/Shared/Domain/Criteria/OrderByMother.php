<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Domain\Criteria;

use Codeyani\Shared\Domain\Criteria\OrderBy;
use Codeyani\Tests\Shared\Domain\WordMother;

final class OrderByMother
{
	public static function create(?string $fieldName = null): OrderBy
	{
		return new OrderBy($fieldName ?? WordMother::create());
	}
}
