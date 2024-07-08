<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Model;

class ValidationResponseModel
{
    public function __construct(
        private readonly bool $isValid,
        private readonly string $fileRealPath,
    ) {
    }

    public function getFileRealPath(): string
    {
        return $this->fileRealPath;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }
}