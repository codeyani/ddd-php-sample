<?php

declare(strict_types=1);

namespace Codeyani\Apps\Backoffice\Frontend\Command;

use Codeyani\Backoffice\Users\Infrastructure\Persistence\ElasticsearchBackofficeUserRepository;
use Codeyani\Backoffice\Users\Infrastructure\Persistence\MySqlBackofficeUserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ImportUsersToElasticsearchCommand extends Command
{
	public function __construct(
		private readonly MySqlBackofficeUserRepository $mySqlRepository,
		private readonly ElasticsearchBackofficeUserRepository $elasticRepository
	) {
		parent::__construct();
	}

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$users = $this->mySqlRepository->searchAll();

		foreach ($users as $user) {
			$this->elasticRepository->save($user);
		}

		return 0;
	}
}
