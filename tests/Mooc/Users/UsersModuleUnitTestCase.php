<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users;

use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class UsersModuleUnitTestCase extends UnitTestCase
{
	private UserRepository|MockInterface|null $repository = null;

	protected function shouldSave(User $user): void
	{
		$this->repository()
			->shouldReceive('save')
			->once()
			->andReturnNull();
	}

	protected function shouldSearch(UserId $id, ?User $user): void
	{
		$this->repository()
			->shouldReceive('search')
			->once()
			->andReturn($user);
	}

	protected function repository(): UserRepository|MockInterface
	{
		return $this->repository ??= $this->mock(UserRepository::class);
	}
}
