<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\SearchByCriteria;

use Codeyani\Backoffice\Users\Application\BackofficeUserResponse;
use Codeyani\Backoffice\Users\Application\BackofficeUsersResponse;
use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;
use Codeyani\Shared\Domain\Criteria\Criteria;
use Codeyani\Shared\Domain\Criteria\Filters;
use Codeyani\Shared\Domain\Criteria\Order;

use function Lambdish\Phunctional\map;

final readonly class BackofficeUsersByCriteriaSearcher
{
	public function __construct(private BackofficeUserRepository $repository) {}

	public function search(Filters $filters, Order $order, ?int $limit, ?int $offset): BackofficeUsersResponse
	{
		$criteria = new Criteria($filters, $order, $offset, $limit);

		return new BackofficeUsersResponse(...map($this->toResponse(), $this->repository->matching($criteria)));
	}

	private function toResponse(): callable
	{
		return static fn (BackofficeUser $user): BackofficeUserResponse => new BackofficeUserResponse(
			$user->id(),
			$user->email(),
			$user->firstName(),
			$user->lastname(),
		);
	}
}
