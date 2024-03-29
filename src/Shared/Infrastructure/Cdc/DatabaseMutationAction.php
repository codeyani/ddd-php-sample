<?php

declare(strict_types=1);

namespace Codeyani\Shared\Infrastructure\Cdc;

enum DatabaseMutationAction: string
{
	case INSERT = 'INSERT';
	case UPDATE = 'UPDATE';
	case DELETE = 'DELETE';
}
