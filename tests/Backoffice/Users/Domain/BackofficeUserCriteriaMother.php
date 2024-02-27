<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Users\Domain;

use Codeyani\Shared\Domain\Criteria\Criteria;
use Codeyani\Tests\Shared\Domain\Criteria\CriteriaMother;
use Codeyani\Tests\Shared\Domain\Criteria\FilterMother;
use Codeyani\Tests\Shared\Domain\Criteria\FiltersMother;

final class BackofficeUserCriteriaMother
{
	public static function nameContains(string $text): Criteria
	{
		return CriteriaMother::create(
			FiltersMother::createOne(
				FilterMother::fromValues([
					'field' => 'name',
					'operator' => 'CONTAINS',
					'value' => $text,
				])
			)
		);
	}
}
