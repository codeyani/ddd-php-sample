<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

use Codeyani\Shared\Domain\Bus\Event\DomainEvent;

final class VideoCreatedDomainEvent extends DomainEvent
{
	public function __construct(
		string $id,
		private readonly string $type,
		private readonly string $title,
		private readonly string $url,
		private readonly string $userId,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($id, $eventId, $occurredOn);
	}

	public static function eventName(): string
	{
		return 'video.created';
	}

	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): self {
		return new self(
			$aggregateId,
			$body['type'],
			$body['title'],
			$body['url'],
			$body['user_id'],
			$eventId,
			$occurredOn
		);
	}

	public function toPrimitives(): array
	{
		return [
			'type' => $this->type,
			'title' => $this->title,
			'url' => $this->url,
			'user_id' => $this->userId,
		];
	}
}
