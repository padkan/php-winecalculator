<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Service\Validation;

use Saeed\Winecalculator\Model\ValidationResponseModel;

interface ValidateInterface
{
    public function validate(array $data): ValidationResponseModel;
}