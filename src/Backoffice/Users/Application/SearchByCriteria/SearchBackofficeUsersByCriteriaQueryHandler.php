<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\SearchByCriteria;

use Codeyani\Backoffice\Users\Application\BackofficeUsersResponse;
use Codeyani\Shared\Domain\Bus\Query\QueryHandler;
use Codeyani\Shared\Domain\Criteria\Filters;
use Codeyani\Shared\Domain\Criteria\Order;

final readonly class SearchBackofficeUsersByCriteriaQueryHandler implements QueryHandler
{
	public function __construct(private BackofficeUsersByCriteriaSearcher $searcher) {}

	public function __invoke(SearchBackofficeUsersByCriteriaQuery $query): BackofficeUsersResponse
	{
		$filters = Filters::fromValues($query->filters());
		$order = Order::fromValues($query->orderBy(), $query->order());

		return $this->searcher->search($filters, $order, $query->limit(), $query->offset());
	}
}
