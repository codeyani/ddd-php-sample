<?php

declare(strict_types=1);

namespace Codeyani\Tests\Shared;

use Codeyani\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use Codeyani\Shared\Domain\Bus\Event\DomainEventSubscriber;
use Codeyani\Shared\Domain\Bus\Query\Response;
use Codeyani\Tests\Shared\Infrastructure\ArchitectureTest;
use Codeyani\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;
use Ramsey\Uuid\Uuid;

final class SharedArchitectureTest
{
	public function test_shared_domain_should_not_import_from_outside(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Codeyani\Shared\Domain'))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
				// Itself
				Selector::inNamespace('Codeyani\Shared\Domain'),
				// Dependencies treated as domain
				Selector::classname(Uuid::class),
			]))
			->because('shared domain cannot import from outside');
	}

	public function test_shared_infrastructure_should_not_import_from_other_contexts(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Codeyani\Shared\Infrastructure'))
			->shouldNotDependOn()
			->classes(Selector::inNamespace('Codeyani'))
			->excluding(
				// Itself
				Selector::inNamespace('Codeyani\Shared'),
				// This need to be refactored
				Selector::classname(MySqlDatabaseCleaner::class),
				Selector::classname(AuthenticateUserCommand::class),
			);
	}

	public function test_all_use_cases_can_only_have_one_public_method(): Rule
	{
		return PHPat::rule()
			->classes(
				Selector::classname('/^Codeyani\\\\.+\\\\.+\\\\Application\\\\.+\\\\(?!.*(?:Command|Query)$).*$/', true)
			)
			->excluding(
				Selector::implements(Response::class),
				Selector::implements(DomainEventSubscriber::class),
				Selector::inNamespace('/.*\\\\Tests\\\\.*/', true)
			)
			->shouldHaveOnlyOnePublicMethod();
	}
}
