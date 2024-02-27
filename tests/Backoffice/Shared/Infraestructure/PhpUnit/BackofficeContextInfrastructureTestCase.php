<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Shared\Infraestructure\PhpUnit;

use Codeyani\Apps\Backoffice\Backend\BackofficeBackendKernel;
use Codeyani\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use Codeyani\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeContextInfrastructureTestCase extends InfrastructureTestCase
{
	protected function setUp(): void
	{
		parent::setUp();

		$arranger = new BackofficeEnvironmentArranger(
			$this->service(ElasticsearchClient::class),
			$this->service(EntityManager::class)
		);

		$arranger->arrange();
	}

	protected function kernelClass(): string
	{
		return BackofficeBackendKernel::class;
	}
}
