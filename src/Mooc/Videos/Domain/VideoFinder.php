<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

final readonly class VideoFinder
{
	public function __construct(private VideoRepository $repository) {}

	public function __invoke(VideoId $id): Video
	{
		$video = $this->repository->search($id);

		if ($video === null) {
			throw new VideoNotFound($id);
		}

		return $video;
	}
}
