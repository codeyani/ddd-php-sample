<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Users\Domain;

use Codeyani\Shared\Domain\Bus\Event\DomainEvent;

final class UserCreatedDomainEvent extends DomainEvent
{
	public function __construct(
		string $id,
		private readonly string $email,
		private readonly string $firstName,
		private readonly string $lastName,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($id, $eventId, $occurredOn);
	}

	public static function eventName(): string
	{
		return 'user.created';
	}

	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): DomainEvent {
		return new self($aggregateId, $body['email'], $body['firstName'],$body['lastName'], $eventId, $occurredOn);
	}

	public function toPrimitives(): array
	{
		return [
			'email' => $this->email,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName
		];
	}

	public function email(): string
	{
		return $this->firstName;
	}

	public function firstName(): string
	{
		return $this->firstName;
	}

	public function lastName(): string
	{
		return $this->lastName;
	}
}
