<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Application\Create;

use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Mooc\Users\Domain\UserLastName;
use Codeyani\Shared\Domain\Bus\Event\EventBus;

final readonly class UserCreator
{
	public function __construct(private UserRepository $repository, private EventBus $bus) {}

	public function __invoke(
		UserId $id,
		UserEmail $email,
		UserFirstName $firstName,
		UserLastName $lastName,
	): void
	{
		$user = User::create($id, $email, $firstName, $lastName);

		$this->repository->save($user);
		$this->bus->publish(...$user->pullDomainEvents());
	}
}
