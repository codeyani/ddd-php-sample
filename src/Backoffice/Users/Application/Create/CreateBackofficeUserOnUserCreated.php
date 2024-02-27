<?php

declare(strict_types=1);

namespace Codeyani\Backoffice\Users\Application\Create;

use Codeyani\Mooc\Users\Domain\UserCreatedDomainEvent;
use Codeyani\Shared\Domain\Bus\Event\DomainEventSubscriber;

final readonly class CreateBackofficeUserOnUserCreated implements DomainEventSubscriber
{
	public function __construct(private BackofficeUserCreator $creator) {}

	public static function subscribedTo(): array
	{
		return [UserCreatedDomainEvent::class];
	}

	public function __invoke(UserCreatedDomainEvent $event): void
	{
		$this->creator->create($event->aggregateId(), $event->email(), $event->firstName(), $event->lastName());
	}
}
