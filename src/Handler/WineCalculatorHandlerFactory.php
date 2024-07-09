<?php

namespace Saeed\Winecalculator\Handler;


use Saeed\Winecalculator\Service\ValidationService\ValidatorServiceFactory;
use Saeed\Winecalculator\Service\FileContentService\FileContentServiceFactory;
use Saeed\Winecalculator\Service\DataExtractorService\DataExtractorServiceFactory;

class WineCalculatorHandlerFactory
{
    public function __invoke(): WineCalculatorHandler
    {
        return new WineCalculatorHandler(
            (new ValidatorServiceFactory())(),
            (new FileContentServiceFactory())(),
            (new DataExtractorServiceFactory())()
        );
    }
}