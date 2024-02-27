<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Domain;

use Codeyani\Shared\Domain\Criteria\Criteria;

interface BackofficeUserRepository
{
	public function save(BackofficeUser $user): void;

	public function searchAll(): array;

	public function matching(Criteria $criteria): array;
}
