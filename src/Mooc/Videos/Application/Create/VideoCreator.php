<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Create;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Shared\Domain\Videos\VideoUrl;
use Codeyani\Mooc\Videos\Domain\Video;
use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Mooc\Videos\Domain\VideoRepository;
use Codeyani\Mooc\Videos\Domain\VideoTitle;
use Codeyani\Mooc\Videos\Domain\VideoType;
use Codeyani\Shared\Domain\Bus\Event\EventBus;

final readonly class VideoCreator
{
	public function __construct(private VideoRepository $repository, private EventBus $bus) {}

	public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, UserId $userId): void
	{
		$video = Video::create($id, $type, $title, $url, $userId);

		$this->repository->save($video);

		$this->bus->publish(...$video->pullDomainEvents());
	}
}
