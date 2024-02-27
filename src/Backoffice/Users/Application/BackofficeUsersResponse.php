<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application;

use Codeyani\Shared\Domain\Bus\Query\Response;

final class BackofficeUsersResponse implements Response
{
	private readonly array $users;

	public function __construct(BackofficeUserResponse ...$users)
	{
		$this->users = $users;
	}

	public function users(): array
	{
		return $this->users;
	}
}
