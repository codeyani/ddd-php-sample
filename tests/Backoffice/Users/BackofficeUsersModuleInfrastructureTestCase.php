<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Users;

use Codeyani\Backoffice\Users\Infrastructure\Persistence\ElasticsearchBackofficeUserRepository;
use Codeyani\Backoffice\Users\Infrastructure\Persistence\MySqlBackofficeUserRepository;
use Codeyani\Tests\Backoffice\Shared\Infraestructure\PhpUnit\BackofficeContextInfrastructureTestCase;
use Doctrine\ORM\EntityManager;

abstract class BackofficeUsersModuleInfrastructureTestCase extends BackofficeContextInfrastructureTestCase
{
	protected function mySqlRepository(): MySqlBackofficeUserRepository
	{
		return new MySqlBackofficeUserRepository($this->service(EntityManager::class));
	}

	protected function elasticRepository(): ElasticsearchBackofficeUserRepository
	{
		return $this->service(ElasticsearchBackofficeUserRepository::class);
	}
}
