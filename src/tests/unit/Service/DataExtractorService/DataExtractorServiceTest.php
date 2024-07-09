<?php
namespace Saeed\Winecalculator\Tests\Unit\Service\DataExtractorService;

use Saeed\Winecalculator\Service\DataExtractorService\DataExtractorService;
use Saeed\Winecalculator\Model\WineModel;

class DataExtractorServiceTest extends \PHPUnit\Framework\TestCase
{
    private $dataExtractorService;

    protected function setUp(): void
    {
        $this->dataExtractorService = new DataExtractorService();
    }
    public function testExtractData()
    {

        $products = [
            [
                'sku' => 'ProductA',
                'price' => 89.99,
                'package_type' => '4x0,75L+1x0,7L+1x0,2L',

            ],
            [
                'sku' => 'ProductB',
                'price' => 29.9,
                'package_type' => '8x0,75L+2x1,0L+1x0,5L+1x0,2L'
            ]
        ];
        
        
        //WineModel mock
        $output = [];
        foreach ($products as $product) {
            $mock = $this->getMockBuilder(WineModel::class)->setConstructorArgs([$product['sku'], $product['price'], $product['package_type']])->onlyMethods(['getSku', 'getPrice', 'getPackageType'])->getMock();
            $mock->method('getSku')->willReturn($product['sku']);
            $mock->method('getPrice')->willReturn($product['price']);
            $mock->method('getPackageType')->willReturn($product['package_type']);
            $mock->expects($this->once())->method('getSku');
            $mock->expects($this->atLeastOnce())->method('getPrice');
            $mock->expects($this->once())->method('getPackageType');
            

            $output[] = $mock;
        }

        $expected = [
            [
                'SKU' => 'ProductA',
                'Package Price' => 89.99,
                'Price/Liter' => 23.07,
                'Bottles' => 6,
                'Liter' => 3.9,
            ],
            [
                'SKU' => 'ProductB',
                'Package Price' => 29.9,
                'Price/Liter' => 2.37,
                'Bottles' => 18,
                'Liter' => 12.6,

            ]
        ];

        $this->assertEquals($expected, $this->dataExtractorService->extractData($output));
    }
}