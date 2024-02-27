<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Application\Update;

use Codeyani\Mooc\Users\Application\Update\UserRenamer;
use Codeyani\Mooc\Users\Domain\UserNotExist;
use Codeyani\Tests\Mooc\Users\Domain\UserFirstNameMother;
use Codeyani\Tests\Mooc\Users\UsersModuleUnitTestCase;
use Codeyani\Tests\Mooc\Users\Domain\UserIdMother;
use Codeyani\Tests\Mooc\Users\Domain\UserMother;
use Codeyani\Tests\Mooc\Users\Domain\UserNameMother;
use Codeyani\Tests\Shared\Domain\DuplicatorMother;

final class UserRenamerTest extends UsersModuleUnitTestCase
{
	private UserRenamer|null $renamer;

	protected function setUp(): void
	{
		parent::setUp();

		$this->renamer = new UserRenamer($this->repository(), $this->eventBus());
	}

	/** @test */
	public function it_should_rename_an_existing_user(): void
	{
		$user = UserMother::create();
		$newName = UserFirstNameMother::create();
		$renamedUser = DuplicatorMother::with($user, ['firstName' => $newName]);

		$this->shouldSearch($user->id(), $user);
		$this->shouldSave($renamedUser);
		$this->shouldNotPublishDomainEvent();

		$this->renamer->__invoke($user->id(), $newName);
	}

	/** @test */
	public function it_should_throw_an_exception_when_the_user_not_exist(): void
	{
		$this->expectException(UserNotExist::class);

		$id = UserIdMother::create();

		$this->shouldSearch($id, null);

		$this->renamer->__invoke($id, UserFirstNameMother::create());
	}
}
