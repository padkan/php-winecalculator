<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\DataExtractorService;

class DataExtractorServiceFactory
{
    public function __invoke(): DataExtractorService
    {
        return new DataExtractorService();
    }
}