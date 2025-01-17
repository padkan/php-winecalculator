<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\DataExtractorService;

class DataExtractorService implements DataExtractorInterface
{
    public function extractData(array $products): array
    {
        $output = [];

        $bottlesCount = 0;
        $sumLiter = 0;
        foreach ($products as $product) {
            $exploded = explode('+', $product->getPackageType());

            foreach ($exploded as $item) {
                preg_match('/(\d)*x([0-9,]*)L/', $item, $matches);
            
                $currentBottleCount = (int)($matches[1] ?? 0);
                $bottlesCount += (int)($matches[1] ?? 0);
                $literOfBottle = (float)(str_replace(',', '.', $matches[2] ?? ''));
                $sumLiter += $currentBottleCount * $literOfBottle;
            }

            $output[] = [
                'SKU' => $product->getSku(),
                'Package Price' => $product->getPrice(),
                'Price/Liter' => round($product->getPrice() / $sumLiter, 2),
                'Bottles' => $bottlesCount,
                'Liter' => round($sumLiter, 2),
            ];
        }

        return $output;
    }
}