<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Infrastructure\Persistence;

use Codeyani\Tests\Mooc\Users\UsersModuleInfrastructureTestCase;
use Codeyani\Tests\Mooc\Users\Domain\UserIdMother;
use Codeyani\Tests\Mooc\Users\Domain\UserMother;

final class UserRepositoryTest extends UsersModuleInfrastructureTestCase
{
	/** @test */
	public function it_should_save_a_user(): void
	{
		$user = UserMother::create();

		$this->repository()->save($user);
	}

	/** @test */
	public function it_should_return_an_existing_user(): void
	{
		$user = UserMother::create();

		$this->repository()->save($user);

		$this->assertEquals($user, $this->repository()->search($user->id()));
	}

	/** @test */
	public function it_should_not_return_a_non_existing_user(): void
	{
		$this->assertNull($this->repository()->search(UserIdMother::create()));
	}
}
