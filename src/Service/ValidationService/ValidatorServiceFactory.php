<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Service\ValidationService;

class ValidatorServiceFactory
{
    public function __invoke(): ValidationService
    {
        return new ValidationService();
    }
}