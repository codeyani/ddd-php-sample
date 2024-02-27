<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Find;

use Codeyani\Mooc\Videos\Domain\Video;
use Codeyani\Mooc\Videos\Domain\VideoFinder as DomainVideoFinder;
use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Mooc\Videos\Domain\VideoRepository;

final class VideoFinder
{
	private readonly DomainVideoFinder $finder;

	public function __construct(VideoRepository $repository)
	{
		$this->finder = new DomainVideoFinder($repository);
	}

	public function __invoke(VideoId $id): Video
	{
		return $this->finder->__invoke($id);
	}
}
