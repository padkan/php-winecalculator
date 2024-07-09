<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\FileContentService;

class FileContentServiceFactory
{
    public function __invoke(): FileContentService
    {
        return new FileContentService();
    }
}