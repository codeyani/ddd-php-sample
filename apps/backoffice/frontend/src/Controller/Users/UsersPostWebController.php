<?php

declare(strict_types=1);

namespace Codeyani\Apps\Backoffice\Frontend\Controller\Users;

use Codeyani\Mooc\Users\Application\Create\CreateUserCommand;
use Codeyani\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class UsersPostWebController extends WebController
{
	public function __invoke(Request $request): RedirectResponse
	{
		$validationErrors = $this->validateRequest($request);

		return $validationErrors->count()
			? $this->redirectWithErrors('users_get', $validationErrors, $request)
			: $this->createUser($request);
	}

	protected function exceptions(): array
	{
		return [];
	}

	private function validateRequest(Request $request): ConstraintViolationListInterface
	{
		$constraint = new Assert\Collection(
			[
				'id' => new Assert\Uuid(),
				'email' => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
				'firstName' => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
				'lastName' => [new Assert\NotBlank(), new Assert\Length(['min' => 1, 'max' => 255])],
			]
		);

		$input = $request->request->all();

		return Validation::createValidator()->validate($input, $constraint);
	}

	private function createUser(Request $request): RedirectResponse
	{
		$this->dispatch(
			new CreateUserCommand(
				(string) $request->request->get('id'),
				(string) $request->request->get('email'),
				(string) $request->request->get('firstName'),
				(string) $request->request->get('lastName')
			)
		);

		return $this->redirectWithMessage(
			'users_get',
			sprintf('Feliciades, el curso %s ha sido creado!', $request->request->getAlpha('name'))
		);
	}
}
