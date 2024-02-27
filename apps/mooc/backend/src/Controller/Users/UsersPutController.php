<?php

declare(strict_types=1);

namespace Codeyani\Apps\Mooc\Backend\Controller\Users;

use Codeyani\Mooc\Users\Application\Create\CreateUserCommand;
use Codeyani\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UsersPutController extends ApiController
{
	public function __invoke(string $id, Request $request): Response
	{
		$this->dispatch(
			new CreateUserCommand(
				$id,
				(string) $request->request->get('email'),
				(string) $request->request->get('firstName'),
				(string) $request->request->get('lastName')
			)
		);

		return new Response('', Response::HTTP_CREATED);
	}

	protected function exceptions(): array
	{
		return [];
	}
}
