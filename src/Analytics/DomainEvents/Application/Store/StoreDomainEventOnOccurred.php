<?php

declare(strict_types=1);

namespace Codeyani\Analytics\DomainEvents\Application\Store;

use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventAggregateId;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventBody;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventId;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventName;
use Codeyani\Shared\Domain\Bus\Event\DomainEvent;
use Codeyani\Shared\Domain\Bus\Event\DomainEventSubscriber;

final readonly class StoreDomainEventOnOccurred implements DomainEventSubscriber
{
	public function __construct(private DomainEventStorer $storer) {}

	public static function subscribedTo(): array
	{
		return [DomainEvent::class];
	}

	public function __invoke(DomainEvent $event): void
	{
		$id = new AnalyticsDomainEventId($event->eventId());
		$aggregateId = new AnalyticsDomainEventAggregateId($event->aggregateId());
		$name = new AnalyticsDomainEventName($event::eventName());
		$body = new AnalyticsDomainEventBody($event->toPrimitives());

		$this->storer->store($id, $aggregateId, $name, $body);
	}
}
