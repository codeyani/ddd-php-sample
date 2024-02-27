<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Create;

use Codeyani\Shared\Domain\Bus\Command\Command;

final readonly class CreateVideoCommand implements Command
{
	public function __construct(
		private string $id,
		private string $type,
		private string $title,
		private string $url,
		private string $userId
	) {}

	public function id(): string
	{
		return $this->id;
	}

	public function type(): string
	{
		return $this->type;
	}

	public function title(): string
	{
		return $this->title;
	}

	public function url(): string
	{
		return $this->url;
	}

	public function userId(): string
	{
		return $this->userId;
	}
}
