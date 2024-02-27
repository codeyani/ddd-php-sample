<?php

declare(strict_types=1);

namespace Codeyani\Apps\Backoffice\Backend\Controller\Users;

use Codeyani\Backoffice\Users\Application\BackofficeUserResponse;
use Codeyani\Backoffice\Users\Application\BackofficeUsersResponse;
use Codeyani\Backoffice\Users\Application\SearchByCriteria\SearchBackofficeUsersByCriteriaQuery;
use Codeyani\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use function Lambdish\Phunctional\map;

final readonly class UsersGetController
{
	public function __construct(private QueryBus $queryBus) {}

	public function __invoke(Request $request): JsonResponse
	{
		$orderBy = $request->query->get('order_by');
		$order = $request->query->get('order');
		$limit = $request->query->get('limit');
		$offset = $request->query->get('offset');

		/** @var BackofficeUsersResponse $response */
		$response = $this->queryBus->ask(
			new SearchBackofficeUsersByCriteriaQuery(
				(array) $request->query->get('filters'),
				$orderBy,
				$order,
				$limit === null ? null : (int) $limit,
				$offset === null ? null : (int) $offset
			)
		);

		return new JsonResponse(
			map(
				fn (BackofficeUserResponse $user): array => [
					'id' => $user->id(),
					'email' => $user->email(),
					'firstName' => $user->firstName(),
					'lastName' => $user->lastName(),
				],
				$response->users()
			),
			200,
			['Access-Control-Allow-Origin' => '*']
		);
	}
}
