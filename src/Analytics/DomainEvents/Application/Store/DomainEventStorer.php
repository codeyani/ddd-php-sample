<?php

declare(strict_types=1);

namespace Codeyani\Analytics\DomainEvents\Application\Store;

use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEvent;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventAggregateId;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventBody;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventId;
use Codeyani\Analytics\DomainEvents\Domain\AnalyticsDomainEventName;
use Codeyani\Analytics\DomainEvents\Domain\DomainEventsRepository;

final readonly class DomainEventStorer
{
	public function __construct(private DomainEventsRepository $repository) {}

	public function store(
		AnalyticsDomainEventId $id,
		AnalyticsDomainEventAggregateId $aggregateId,
		AnalyticsDomainEventName $name,
		AnalyticsDomainEventBody $body
	): void {
		$domainEvent = new AnalyticsDomainEvent($id, $aggregateId, $name, $body);

		$this->repository->save($domainEvent);
	}
}
