<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared\Domain;

use Codeyani\Tests\Shared\Infrastructure\Mockery\CodelyTvMatcherIsSimilar;
use Codeyani\Tests\Shared\Infrastructure\PhpUnit\Constraint\CodelyTvConstraintIsSimilar;

final class TestUtils
{
	public static function isSimilar(mixed $expected, mixed $actual): bool
	{
		$constraint = new CodelyTvMatcherIsSimilar($expected);

		return $constraint->evaluate($actual, '', true);
	}

	public static function assertSimilar(mixed $expected, mixed $actual): void
	{
		$constraint = new CodelyTvMatcherIsSimilar($expected);

		$constraint->evaluate($actual);
	}

	public static function similarTo(mixed $value, float $delta = 0.0): CodelyTvConstraintIsSimilar
	{
		return new CodelyTvConstraintIsSimilar($value, $delta);
	}
}
