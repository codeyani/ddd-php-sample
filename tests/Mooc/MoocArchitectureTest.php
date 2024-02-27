<?php

declare(strict_types=1);

namespace Codeyani\Tests\Mooc;

use Codeyani\Tests\Shared\Infrastructure\ArchitectureTest;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class MoocArchitectureTest
{
	public function test_mooc_domain_should_only_import_itself_and_shared(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('/^Codeyani\\\\Mooc\\\\.+\\\\Domain/', true))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
				// Itself
				Selector::inNamespace('/^Codeyani\\\\Mooc\\\\.+\\\\Domain/', true),
				// Shared
				Selector::inNamespace('Codeyani\Shared\Domain'),
			]))
			->because('mooc domain can only import itself and shared domain');
	}

	public function test_mooc_application_should_only_import_itself_and_domain(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('/^Codeyani\\\\Mooc\\\\.+\\\\Application/', true))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
				// Itself
				Selector::inNamespace('/^Codeyani\\\\Mooc\\\\.+\\\\Application/', true),
				Selector::inNamespace('/^Codeyani\\\\Mooc\\\\.+\\\\Domain/', true),
				// Shared
				Selector::inNamespace('Codeyani\Shared'),
			]))
			->because('mooc application can only import itself and shared');
	}

	public function test_mooc_infrastructure_should_not_import_other_contexts_beside_shared(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Codeyani\Mooc'))
			->shouldNotDependOn()
			->classes(Selector::inNamespace('Codeyani'))
			->excluding(
				// Itself
				Selector::inNamespace('Codeyani\Mooc'),
				// Shared
				Selector::inNamespace('Codeyani\Shared'),
			);
	}
}
