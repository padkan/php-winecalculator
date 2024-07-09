<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\DataExtractorService;

interface DataExtractorInterface
{
    public function extractData(array $products): array;
}