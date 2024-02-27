<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Shared\Domain\Videos\VideoUrl;
use Codeyani\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
	public function __construct(
		private readonly VideoId $id,
		private readonly VideoType $type,
		private VideoTitle $title,
		private readonly VideoUrl $url,
		private readonly UserId $userId
	) {}

	public static function create(
		VideoId $id,
		VideoType $type,
		VideoTitle $title,
		VideoUrl $url,
		UserId $userId
	): self {
		$video = new self($id, $type, $title, $url, $userId);

		$video->record(
			new VideoCreatedDomainEvent($id->value(), $type->value, $title->value(), $url->value(), $userId->value())
		);

		return $video;
	}

	public function updateTitle(VideoTitle $newTitle): void
	{
		$this->title = $newTitle;
	}

	public function id(): VideoId
	{
		return $this->id;
	}

	public function type(): VideoType
	{
		return $this->type;
	}

	public function title(): VideoTitle
	{
		return $this->title;
	}

	public function url(): VideoUrl
	{
		return $this->url;
	}

	public function userId(): UserId
	{
		return $this->userId;
	}
}
