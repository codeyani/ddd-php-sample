<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Infrastructure\Persistence;

use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;
use Codeyani\Shared\Domain\Criteria\Criteria;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class MySqlBackofficeUserRepository extends DoctrineRepository implements BackofficeUserRepository
{
	public function save(BackofficeUser $user): void
	{
		$this->persist($user);
	}

	public function searchAll(): array
	{
		return $this->repository(BackofficeUser::class)->findAll();
	}

	public function matching(Criteria $criteria): array
	{
		$doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

		return $this->repository(BackofficeUser::class)->matching($doctrineCriteria)->toArray();
	}
}
