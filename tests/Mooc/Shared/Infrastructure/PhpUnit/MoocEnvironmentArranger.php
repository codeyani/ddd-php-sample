<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Shared\Infrastructure\PhpUnit;

use Codeyani\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use Codeyani\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use Doctrine\ORM\EntityManager;

use function Lambdish\Phunctional\apply;

final readonly class MoocEnvironmentArranger implements EnvironmentArranger
{
	public function __construct(private EntityManager $entityManager) {}

	public function arrange(): void
	{
		apply(new MySqlDatabaseCleaner(), [$this->entityManager]);
	}

	public function close(): void {}
}
