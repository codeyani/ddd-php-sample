<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Infrastructure\Persistence\Doctrine;

use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class VideoIdType extends UuidType
{
	protected function typeClassName(): string
	{
		return VideoId::class;
	}
}
