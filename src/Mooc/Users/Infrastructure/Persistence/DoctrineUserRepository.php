<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Infrastructure\Persistence;

use Codeyani\Mooc\Users\Domain\User;
use Codeyani\Mooc\Users\Domain\UserRepository;
use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
	public function save(User $user): void
	{
		$this->persist($user);
	}

	public function search(UserId $id): ?User
	{
		return $this->repository(User::class)->find($id);
	}
}
