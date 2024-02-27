<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Update;

use Codeyani\Mooc\Videos\Domain\VideoFinder;
use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Mooc\Videos\Domain\VideoRepository;
use Codeyani\Mooc\Videos\Domain\VideoTitle;

final readonly class VideoTitleUpdater
{
	private VideoFinder $finder;

	public function __construct(private VideoRepository $repository)
	{
		$this->finder = new VideoFinder($repository);
	}

	public function __invoke(VideoId $id, VideoTitle $newTitle): void
	{
		$video = $this->finder->__invoke($id);

		$video->updateTitle($newTitle);

		$this->repository->save($video);
	}
}
