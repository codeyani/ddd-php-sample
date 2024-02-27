<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Infrastructure\Cdc;

use Codeyani\Mooc\Users\Domain\UserCreatedDomainEvent;
use Codeyani\Shared\Domain\Bus\Event\DomainEvent;
use Codeyani\Shared\Domain\Utils;
use Codeyani\Shared\Infrastructure\Cdc\DatabaseMutationAction;
use Codeyani\Shared\Infrastructure\Cdc\DatabaseMutationToDomainEvent;

final class DatabaseMutationToUserCreatedDomainEvent implements DatabaseMutationToDomainEvent
{
	/** @return DomainEvent[] */
	public function transform(array $data): array
	{
		$mutation = Utils::jsonDecode($data['new_value']);

		return [
			new UserCreatedDomainEvent(
				$mutation['id'],
				$mutation['email'],
				$mutation['firstName'],
				$mutation['lastName'],
				null,
				$data['mutation_timestamp'],
			),
		];
	}

	public function tableName(): string
	{
		return 'users';
	}

	public function mutationAction(): DatabaseMutationAction
	{
		return DatabaseMutationAction::INSERT;
	}
}
