<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Service;

use Saeed\Winecalculator\Model\ValidationResponseModel;

interface ValidateInterface
{
    public function validate(array $data): ValidationResponseModel;
}