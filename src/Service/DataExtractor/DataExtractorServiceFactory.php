<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\DataExtractor;

class DataExtractorServiceFactory
{
    public function __invoke(): DataExtractorService
    {
        return new DataExtractorService();
    }
}