<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\File;

class FileServiceFactory
{
    public function __invoke(): FileService
    {
        return new FileService();
    }
}