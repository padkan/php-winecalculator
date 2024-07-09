<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Handler;

use Saeed\Winecalculator\Model\WineModel;
use Saeed\Winecalculator\Service\ValidationService\ValidationService;
use Saeed\Winecalculator\Service\FileContentService\FileContentService;
use Saeed\Winecalculator\Service\DataExtractorService\DataExtractorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WineCalculatorHandler extends Command
{
    private const INPUT_PARAMETER_NAME = 'input';

    public function __construct(private ValidationService $validationService, private FileContentService $fileContentService, private DataExtractorService $dataExtractorService)
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
        $content = $this->fileContentService->read($validationResponse->getFileRealPath());
        $finalOutput = $this->dataExtractorService->extractData($content);
        $tableRows = [];
        foreach ($finalOutput as $item) {
            $tableRows[] = [
                $item['SKU'],
                $item['Package Price'],
                $item['Price/Liter'],
                $item['Bottles'],
                $item['Liter'],
            ];
        }
        $table = new Table($output);
        $table
            ->setHeaders(['SKU', 'Package Price', 'Price/Liter', 'Bottles', 'Liter'])
            ->setRows($tableRows)
        ;
        $table->render();
        return Command::SUCCESS;
    }

}