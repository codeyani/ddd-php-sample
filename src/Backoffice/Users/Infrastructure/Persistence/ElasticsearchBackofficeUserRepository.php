<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Infrastructure\Persistence;

use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;
use Codeyani\Shared\Domain\Criteria\Criteria;
use Codeyani\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchRepository;

use function Lambdish\Phunctional\map;

final class ElasticsearchBackofficeUserRepository extends ElasticsearchRepository implements BackofficeUserRepository
{
	public function save(BackofficeUser $user): void
	{
		$this->persist($user->id(), $user->toPrimitives());
	}

	public function searchAll(): array
	{
		return map($this->toUser(), $this->searchAllInElastic());
	}

	public function matching(Criteria $criteria): array
	{
		return map($this->toUser(), $this->searchByCriteria($criteria));
	}

	protected function aggregateName(): string
	{
		return 'users';
	}

	private function toUser(): callable
	{
		return static fn (array $primitives): BackofficeUser => BackofficeUser::fromPrimitives($primitives);
	}
}
