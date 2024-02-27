<?php

declare(strict_types=1);

namespace Codeyani\Shared\Infrastructure\Bus\Event;

use Codeyani\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Codeyani\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Codeyani\Shared\Infrastructure\Bus\Event\RabbitMq\RabbitMqQueueNameFormatter;
use RuntimeException;
use Traversable;

use function Lambdish\Phunctional\search;

final class DomainEventSubscriberLocator
{
	private readonly array $mapping;

	public function __construct(Traversable $mapping)
	{
		$this->mapping = iterator_to_array($mapping);
	}

	public function allSubscribedTo(string $eventClass): array
	{
		$formatted = CallableFirstParameterExtractor::forPipedCallables($this->mapping);

		return $formatted[$eventClass];
	}

	public function withRabbitMqQueueNamed(string $queueName): callable|DomainEventSubscriber
	{
		$subscriber = search(
			static fn (DomainEventSubscriber $subscriber): bool => RabbitMqQueueNameFormatter::format($subscriber) ===
															$queueName,
			$this->mapping
		);

		if ($subscriber === null) {
			throw new RuntimeException("There are no subscribers for the <$queueName> queue");
		}

		return $subscriber;
	}

	public function all(): array
	{
		return $this->mapping;
	}
}
