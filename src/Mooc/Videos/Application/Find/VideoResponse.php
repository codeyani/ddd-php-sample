<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Find;

use Codeyani\Shared\Domain\Bus\Query\Response;

final readonly class VideoResponse implements Response
{
	public function __construct(
		private string $id,
		private string $type,
		private string $title,
		private string $url,
		private string $userId
	) {}
}
