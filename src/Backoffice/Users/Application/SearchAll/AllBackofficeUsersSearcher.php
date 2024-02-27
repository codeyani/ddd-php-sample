<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\SearchAll;

use Codeyani\Backoffice\Users\Application\BackofficeUserResponse;
use Codeyani\Backoffice\Users\Application\BackofficeUsersResponse;
use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;

use function Lambdish\Phunctional\map;

final readonly class AllBackofficeUsersSearcher
{
	public function __construct(private BackofficeUserRepository $repository) {}

	public function searchAll(): BackofficeUsersResponse
	{
		return new BackofficeUsersResponse(...map($this->toResponse(), $this->repository->searchAll()));
	}

	private function toResponse(): callable
	{
		return static fn (BackofficeUser $user): BackofficeUserResponse => new BackofficeUserResponse(
			$user->id(),
			$user->email(),
			$user->firstName(),
			$user->lastName(),
		);
	}
}
