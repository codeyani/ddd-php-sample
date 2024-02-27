<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Trim;

use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Shared\Domain\SecondsInterval;

final class VideoTrimmer
{
	public function trim(VideoId $id, SecondsInterval $interval): void {}
}
