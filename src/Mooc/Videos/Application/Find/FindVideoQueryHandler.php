<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Find;

use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Shared\Domain\Bus\Query\QueryHandler;

use function Lambdish\Phunctional\apply;

final readonly class FindVideoQueryHandler implements QueryHandler
{
	private VideoResponseConverter $responseConverter;

	public function __construct(private VideoFinder $finder)
	{
		$this->responseConverter = new VideoResponseConverter();
	}

	public function __invoke(FindVideoQuery $query): VideoResponse
	{
		$id = new VideoId($query->id());

		$video = apply($this->finder, [$id]);

		return apply($this->responseConverter, [$video]);
	}
}
