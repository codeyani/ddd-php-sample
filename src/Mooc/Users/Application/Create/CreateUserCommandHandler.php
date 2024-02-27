<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Application\Create;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Users\Domain\UserEmail;
use Codeyani\Mooc\Users\Domain\UserFirstName;
use Codeyani\Mooc\Users\Domain\UserLastName;
use Codeyani\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateUserCommandHandler implements CommandHandler
{
	public function __construct(private UserCreator $creator) {}

	public function __invoke(CreateUserCommand $command): void
	{
		$id = new UserId($command->id());
		$email = new UserEmail($command->email());
		$firstName = new UserFirstName($command->firstName());
		$lastName = new UserLastName($command->lastName());

		$this->creator->__invoke($id, $email, $firstName, $lastName);
	}
}
