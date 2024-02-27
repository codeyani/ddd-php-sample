<?php

declare(strict_types=1);

namespace Codeyani\Tests\Backoffice\Users\Infrastructure\Persistence;

use Codeyani\Tests\Backoffice\Users\BackofficeUsersModuleInfrastructureTestCase;
use Codeyani\Tests\Backoffice\Users\Domain\BackofficeUserCriteriaMother;
use Codeyani\Tests\Backoffice\Users\Domain\BackofficeUserMother;
use Codeyani\Tests\Shared\Domain\Criteria\CriteriaMother;

final class ElasticsearchBackofficeUserRepositoryTest extends BackofficeUsersModuleInfrastructureTestCase
{
	/** @test */
	public function it_should_save_a_valid_user(): void
	{
		$this->elasticRepository()->save(BackofficeUserMother::create());
	}
}
