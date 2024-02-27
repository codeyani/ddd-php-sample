<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\SearchAll;

use Codeyani\Backoffice\Users\Application\BackofficeUsersResponse;
use Codeyani\Shared\Domain\Bus\Query\QueryHandler;

final readonly class SearchAllBackofficeUsersQueryHandler implements QueryHandler
{
	public function __construct(private AllBackofficeUsersSearcher $searcher) {}

	public function __invoke(SearchAllBackofficeUsersQuery $query): BackofficeUsersResponse
	{
		return $this->searcher->searchAll();
	}
}
