<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Auth\Infrastructure\Persistence;

use Codeyani\Backoffice\Auth\Domain\AuthPassword;
use Codeyani\Backoffice\Auth\Domain\AuthRepository;
use Codeyani\Backoffice\Auth\Domain\AuthUser;
use Codeyani\Backoffice\Auth\Domain\AuthUsername;

use function Lambdish\Phunctional\get;

final class InMemoryAuthRepository implements AuthRepository
{
	private const USERS = [
		'javi' => 'barbitas',
		'rafa' => 'pelazo',
	];

	public function search(AuthUsername $username): ?AuthUser
	{
		$password = get($username->value(), self::USERS);

		return $password !== null ? new AuthUser($username, new AuthPassword($password)) : null;
	}
}
