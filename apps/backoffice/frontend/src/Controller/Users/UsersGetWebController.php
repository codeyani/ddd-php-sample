<?php

declare(strict_types=1);

namespace Codeyani\Apps\Backoffice\Frontend\Controller\Users;

use Codeyani\Shared\Domain\ValueObject\SimpleUuid;
use Codeyani\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UsersGetWebController extends WebController
{
	public function __invoke(Request $request): Response
	{
		return $this->render(
			'pages/users/users.html.twig',
			[
				'title' => 'Users',
				'description' => 'Users Codeyani - Backoffice',
				'new_user_id' => SimpleUuid::random()->value(),
			]
		);
	}

	protected function exceptions(): array
	{
		return [];
	}
}
