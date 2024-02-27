<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Application\Create;

use Codeyani\Mooc\Shared\Domain\Users\UserId;
use Codeyani\Mooc\Shared\Domain\Videos\VideoUrl;
use Codeyani\Mooc\Videos\Domain\VideoId;
use Codeyani\Mooc\Videos\Domain\VideoTitle;
use Codeyani\Mooc\Videos\Domain\VideoType;
use Codeyani\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateVideoCommandHandler implements CommandHandler
{
	public function __construct(private VideoCreator $creator) {}

	public function __invoke(CreateVideoCommand $command): void
	{
		$id = new VideoId($command->id());
		$type = VideoType::from($command->type());
		$title = new VideoTitle($command->title());
		$url = new VideoUrl($command->url());
		$userId = new UserId($command->userId());

		$this->creator->create($id, $type, $title, $url, $userId);
	}
}
