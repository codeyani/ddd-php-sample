<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Shared\Infraestructure\PhpUnit;

use Codeyani\Shared\Infrastructure\Elasticsearch\ElasticsearchClient;
use Codeyani\Tests\Shared\Infrastructure\Arranger\EnvironmentArranger;
use Codeyani\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use Codeyani\Tests\Shared\Infrastructure\Elastic\ElasticDatabaseCleaner;
use Doctrine\ORM\EntityManager;

use function Lambdish\Phunctional\apply;

final readonly class BackofficeEnvironmentArranger implements EnvironmentArranger
{
	public function __construct(private ElasticsearchClient $elasticsearchClient, private EntityManager $entityManager) {}

	public function arrange(): void
	{
		apply(new ElasticDatabaseCleaner(), [$this->elasticsearchClient]);
		apply(new MySqlDatabaseCleaner(), [$this->entityManager]);
	}

	public function close(): void {}
}
