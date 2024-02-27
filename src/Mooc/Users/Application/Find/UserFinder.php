<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Application\Find;

use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Users\Domain\UserNotExist;
use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Mooc\Shared\Domain\Users\UserId;

final readonly class UserFinder
{
	public function __construct(private UserRepository $repository) {}

	public function __invoke(UserId $id): User
	{
		$user = $this->repository->search($id);

		if ($user === null) {
			throw new UserNotExist($id);
		}

		return $user;
	}
}
