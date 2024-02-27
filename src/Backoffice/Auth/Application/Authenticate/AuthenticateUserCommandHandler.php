<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Auth\Application\Authenticate;

use Codeyani\Backoffice\Auth\Domain\AuthPassword;
use Codeyani\Backoffice\Auth\Domain\AuthUsername;
use Codeyani\Shared\Domain\Bus\Command\CommandHandler;

final readonly class AuthenticateUserCommandHandler implements CommandHandler
{
	public function __construct(private UserAuthenticator $authenticator) {}

	public function __invoke(AuthenticateUserCommand $command): void
	{
		$username = new AuthUsername($command->username());
		$password = new AuthPassword($command->password());

		$this->authenticator->authenticate($username, $password);
	}
}
