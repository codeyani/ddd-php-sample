<?php

declare(strict_types=1);

namespace Codeyani\Mooc\Videos\Domain;

enum VideoType: string
{
	case SCREENCAST = 'screencast';
	case INTERVIEW = 'interview';
}
