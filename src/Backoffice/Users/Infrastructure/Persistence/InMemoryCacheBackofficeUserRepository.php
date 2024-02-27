<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Infrastructure\Persistence;

use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;
use Codeyani\Shared\Domain\Criteria\Criteria;

use function Lambdish\Phunctional\get;

final class InMemoryCacheBackofficeUserRepository implements BackofficeUserRepository
{
	private static array $allUsersCache = [];
	private static array $matchingCache = [];

	public function __construct(private readonly BackofficeUserRepository $repository) {}

	public function save(BackofficeUser $user): void
	{
		$this->repository->save($user);
	}

	public function searchAll(): array
	{
		return empty(self::$allUsersCache) ? $this->searchAllAndFillCache() : self::$allUsersCache;
	}

	public function matching(Criteria $criteria): array
	{
		return get($criteria->serialize(), self::$matchingCache) ?: $this->searchMatchingAndFillCache($criteria);
	}

	private function searchAllAndFillCache(): array
	{
		return self::$allUsersCache = $this->repository->searchAll();
	}

	private function searchMatchingAndFillCache(Criteria $criteria): array
	{
		return self::$matchingCache[$criteria->serialize()] = $this->repository->matching($criteria);
	}
}
