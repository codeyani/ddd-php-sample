<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\Create;

use Codeyani\Backoffice\Users\Domain\BackofficeUser;
use Codeyani\Backoffice\Users\Domain\BackofficeUserRepository;

final readonly class BackofficeUserCreator
{
	public function __construct(private BackofficeUserRepository $repository) {}

	public function create(
		string $id,
		string $email,
		string $firstName,
		string $lastName
	): void
	{
		$this->repository->save(
			new BackofficeUser($id, $email, $firstName, $lastName)
		);
	}
}
