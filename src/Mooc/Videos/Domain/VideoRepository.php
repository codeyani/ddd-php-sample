<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

use Codeyani\Shared\Domain\Criteria\Criteria;

interface VideoRepository
{
	public function save(Video $video): void;

	public function search(VideoId $id): ?Video;

	public function searchByCriteria(Criteria $criteria): Videos;
}
