<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\DataExtractor;

interface DataExtractorInterface
{
    public function extractData(array $products): array;
}