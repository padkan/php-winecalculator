<?php
declare(strict_types=1);

namespace Saeed\Winecalculator\Service\FileContentService;

use Saeed\Winecalculator\Model\WineModel;


class  FileContentService implements FileContentInterface
{
    public function read(string $filePath): array
    {
        $output = [];
        try {

            $fileContent = json_decode(file_get_contents($filePath), true, 512, JSON_THROW_ON_ERROR);
            foreach ($fileContent as $product) {
                $output[] = new WineModel(
                    $product['sku'],
                    $product['price'],
                    str_replace(' ', '', $product['package_type'])
                );
            }

            return $output;
        } catch (\JsonException $e) {
            return [];
        }
    }
}