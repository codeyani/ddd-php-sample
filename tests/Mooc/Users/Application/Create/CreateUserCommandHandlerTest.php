<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc\Users\Application\Create;

use Codeyani\Mooc\Users\Application\Create\UserCreator;
use Codeyani\Mooc\Users\Application\Create\CreateUserCommandHandler;
use Codeyani\Tests\Mooc\Users\UsersModuleUnitTestCase;
use Codeyani\Tests\Mooc\Users\Domain\UserCreatedDomainEventMother;
use Codeyani\Tests\Mooc\Users\Domain\UserMother;

final class CreateUserCommandHandlerTest extends UsersModuleUnitTestCase
{
	private CreateUserCommandHandler|null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new CreateUserCommandHandler(new UserCreator($this->repository(), $this->eventBus()));
	}

	/** @test */
	public function it_should_create_a_valid_user(): void
	{
		$command = CreateUserCommandMother::create();

		$user = UserMother::fromRequest($command);
		$domainEvent = UserCreatedDomainEventMother::fromUser($user);

		$this->shouldSave($user);
		$this->shouldPublishDomainEvent($domainEvent);

		$this->dispatch($command, $this->handler);
	}
}
