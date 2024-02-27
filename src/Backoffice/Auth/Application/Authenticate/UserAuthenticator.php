<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Auth\Application\Authenticate;

use Codeyani\Backoffice\Auth\Domain\AuthPassword;
use Codeyani\Backoffice\Auth\Domain\AuthRepository;
use Codeyani\Backoffice\Auth\Domain\AuthUser;
use Codeyani\Backoffice\Auth\Domain\AuthUsername;
use Codeyani\Backoffice\Auth\Domain\InvalidAuthCredentials;
use Codeyani\Backoffice\Auth\Domain\InvalidAuthUsername;

final readonly class UserAuthenticator
{
	public function __construct(private AuthRepository $repository) {}

	public function authenticate(AuthUsername $username, AuthPassword $password): void
	{
		$auth = $this->repository->search($username);

		if ($auth === null) {
			throw new InvalidAuthUsername($username);
		}

		$this->ensureCredentialsAreValid($auth, $password);
	}

	private function ensureCredentialsAreValid(AuthUser $auth, AuthPassword $password): void
	{
		if (!$auth->passwordMatches($password)) {
			throw new InvalidAuthCredentials($auth->username());
		}
	}
}
