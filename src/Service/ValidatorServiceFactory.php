<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Service;

class ValidatorServiceFactory
{
    public function __invoke(): ValidationService
    {
        return new ValidationService();
    }
}