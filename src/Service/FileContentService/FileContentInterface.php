<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\FileContentService;

interface FileContentInterface
{
    public function read(string $filePath): array;
}