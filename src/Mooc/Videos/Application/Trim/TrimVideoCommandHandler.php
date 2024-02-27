<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Trim;

use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Shared\Domain\SecondsInterval;

final readonly class TrimVideoCommandHandler
{
	public function __construct(private VideoTrimmer $trimmer) {}

	public function __invoke(TrimVideoCommand $command): void
	{
		$id = new VideoId($command->videoId());
		$interval = SecondsInterval::fromValues($command->keepFromSecond(), $command->keepToSecond());

		$this->trimmer->trim($id, $interval);
	}
}
