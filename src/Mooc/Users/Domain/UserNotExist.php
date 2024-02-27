<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Domain;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Shared\Domain\DomainError;

final class UserNotExist extends DomainError
{
	public function __construct(private readonly UserId $id)
	{
		parent::__construct();
	}

	public function errorCode(): string
	{
		return 'user_not_exist';
	}

	protected function errorMessage(): string
	{
		return sprintf('The user <%s> does not exist', $this->id->value());
	}
}
