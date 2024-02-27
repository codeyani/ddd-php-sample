<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Application\Update;

use Codeyani\Mooc\Users\Application\Find\UserFinder;
use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Shared\Domain\Bus\Event\EventBus;

final readonly class UserRenamer
{
	private UserFinder $finder;

	public function __construct(private UserRepository $repository, private EventBus $bus)
	{
		$this->finder = new UserFinder($repository);
	}

	public function __invoke(UserId $id, UserFirstName $newName): void
	{
		$user = $this->finder->__invoke($id);

		$user->rename($newName);

		$this->repository->save($user);
		$this->bus->publish(...$user->pullDomainEvents());
	}
}
