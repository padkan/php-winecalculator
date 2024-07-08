<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Handler;

use Saeed\Winecalculator\Model\WineModel;
use Saeed\Winecalculator\Service\ValidationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WineCalculatorHandler extends Command
{
    private const INPUT_PARAMETER_NAME = 'input';

    public function __construct(private ValidationService $validationService)
    {
        parent::__construct('WINE:catalog');
    }

    protected function configure(): void
    {
        $this->addArgument(self::INPUT_PARAMETER_NAME, InputArgument::REQUIRED, 'The Json file for product.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Welcome to catalog');
        $jsonFilePath = $input->getArgument(self::INPUT_PARAMETER_NAME);
        $validationResponse = $this->validationService->validate(
            ['path' => $jsonFilePath]
        );
        if (!$validationResponse->isValid()) {
            $output->writeln('Can not access to file that you provided. Try again');
            return Command::INVALID;
        }

        $output->writeln($validationResponse->getFileRealPath());

        $content = $this->getFileContent($validationResponse->getFileRealPath());
        $finalOutput = $this->extractData($content);
        $table = new Table($output);
        $table
            ->setHeaders(['ISBN', 'Title', 'Author'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
                ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
                ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
            ])
        ;
        $table->render();
        return Command::SUCCESS;
    }

    /** @param array<WineModel> $products */
    private function extractData(array $products)
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
                'Price/Liter' => $product->getPrice() / $sumLiter,
                'Bottles' => $bottlesCount,
                'Liter' => $sumLiter,
            ];
        }

        return $output;
    }


    // TODO: Move to a service
    private function getFileContent(string $filePath): array
    {
        $output = [];
        try {
            // TODO: Create a model out of it
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