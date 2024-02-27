<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Shared\Infrastructure\Doctrine;

use Codeyani\Shared\Infrastructure\Doctrine\DoctrineEntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;

final class MoocEntityManagerFactory
{
	private const SCHEMA_PATH = __DIR__ . '/../../../../../etc/databases/mooc.sql';

	public static function create(array $parameters, string $environment): EntityManagerInterface
	{
		$isDevMode = $environment !== 'prod';

		$prefixes = array_merge(
			DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Mooc', 'Codeyani\Mooc'),
			DoctrinePrefixesSearcher::inPath(__DIR__ . '/../../../../Backoffice', 'Codeyani\Backoffice')
		);

		$dbalCustomTypesClasses = DbalTypesSearcher::inPath(__DIR__ . '/../../../../Mooc', 'Mooc');

		return DoctrineEntityManagerFactory::create(
			$parameters,
			$prefixes,
			$isDevMode,
			self::SCHEMA_PATH,
			$dbalCustomTypesClasses
		);
	}
}
