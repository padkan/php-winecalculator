<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\File;

interface FileInterface
{
    public function read(string $filePath): array;
}