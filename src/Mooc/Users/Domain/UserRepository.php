<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Domain;

use Codeyani\Mooc\Shared\Domain\Users\UserId;

interface UserRepository
{
	public function save(User $user): void;

	public function search(UserId $id): ?User;
}
