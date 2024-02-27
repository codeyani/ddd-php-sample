<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users;

use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Tests\Mooc\Shared\Infrastructure\PhpUnit\MoocContextInfrastructureTestCase;

abstract class UsersModuleInfrastructureTestCase extends MoocContextInfrastructureTestCase
{
	protected function repository(): UserRepository
	{
		return $this->service(UserRepository::class);
	}
}
