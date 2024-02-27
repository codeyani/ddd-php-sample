<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Domain\Criteria;

use Codeyani\Shared\Domain\Criteria\Filter;
use Codeyani\Shared\Domain\Criteria\FilterField;
use Codeyani\Shared\Domain\Criteria\FilterOperator;
use Codeyani\Shared\Domain\Criteria\FilterValue;
use Codeyani\Tests\Shared\Domain\RandomElementPicker;

final class FilterMother
{
	public static function create(
		?FilterField $field = null,
		?FilterOperator $operator = null,
		?FilterValue $value = null
	): Filter {
		return new Filter(
			$field ?? FilterFieldMother::create(),
			$operator ?? self::randomOperator(),
			$value ?? FilterValueMother::create()
		);
	}

	/** @param string[] $values */
	public static function fromValues(array $values): Filter
	{
		return Filter::fromValues($values);
	}


	private static function randomOperator(): FilterOperator
	{
		return RandomElementPicker::from(
			FilterOperator::EQUAL,
			FilterOperator::NOT_EQUAL,
			FilterOperator::GT,
			FilterOperator::LT,
			FilterOperator::CONTAINS,
			FilterOperator::NOT_CONTAINS
		);
	}
}
