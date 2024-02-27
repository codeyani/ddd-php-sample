<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Shared\Infrastructure\PhpUnit;

use Codeyani\Apps\Mooc\Backend\MoocBackendKernel;
use Codeyani\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class MoocContextInfrastructureTestCase extends InfrastructureTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		$arranger = new MoocEnvironmentArranger($this->service(EntityManager::class));

		$arranger->arrange();
	}

	protected function tearDown(): void
	{
		$arranger = new MoocEnvironmentArranger($this->service(EntityManager::class));

		$arranger->close();

		parent::tearDown();
	}

	protected function kernelClass(): string
	{
		return MoocBackendKernel::class;
	}
}
