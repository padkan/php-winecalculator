<?php

namespace Saeed\Winecalculator\Handler;


use Saeed\Winecalculator\Service\Validation\ValidatorServiceFactory;
use Saeed\Winecalculator\Service\File\FileServiceFactory;
use Saeed\Winecalculator\Service\DataExtractor\DataExtractorServiceFactory;

class WineCalculatorHandlerFactory
{
    public function __invoke(): WineCalculatorHandler
    {
        return new WineCalculatorHandler(
            (new ValidatorServiceFactory())(),
            (new FileServiceFactory())(),
            (new DataExtractorServiceFactory())()
        );
    }
}