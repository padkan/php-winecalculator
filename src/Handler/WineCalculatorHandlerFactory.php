<?php

namespace Saeed\Winecalculator\Handler;


use Saeed\Winecalculator\Service\ValidatorServiceFactory;

class WineCalculatorHandlerFactory
{
    public function __invoke(): WineCalculatorHandler
    {
        return new WineCalculatorHandler(
            (new ValidatorServiceFactory())()
        );
    }
}