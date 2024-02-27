<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Infrastructure\Persistence;

use Codeyani\Mooc\Videos\Domain\Video;
use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Mooc\Videos\Domain\VideoRepository;
use Codeyani\Mooc\Videos\Domain\Videos;
use Codeyani\Shared\Domain\Criteria\Criteria;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\DoctrineCriteriaConverter;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class VideoRepositoryMySql extends DoctrineRepository implements VideoRepository
{
	private static array $criteriaToDoctrineFields = [
		'id' => 'id',
		'type' => 'type',
		'title' => 'title',
		'url' => 'url',
		'user_id' => 'userId',
	];

	public function save(Video $video): void
	{
		$this->persist($video);
	}

	public function search(VideoId $id): ?Video
	{
		return $this->repository(Video::class)->find($id);
	}

	public function searchByCriteria(Criteria $criteria): Videos
	{
		$doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, self::$criteriaToDoctrineFields);
		$videos = $this->repository(Video::class)->matching($doctrineCriteria)->toArray();

		return new Videos($videos);
	}
}
