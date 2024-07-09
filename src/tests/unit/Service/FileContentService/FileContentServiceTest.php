<?php

namespace Saeed\Winecalculator\Service\FileContentService;

use PHPUnit\Framework\TestCase;
use Saeed\Winecalculator\Service\FileContentService\FileContentService;
use Saeed\Winecalculator\Model\WineModel;

class FileContentServiceTest extends \PHPUnit\Framework\TestCase
{
    private $fileContentService;

    protected function setUp(): void
    {
        $this->fileContentService = new FileContentService();
    }

    public function testReadSuccess()
    {
        $filePath = 'src/tests/unit/helpers/data/products.json';
        $content = $this->fileContentService->read($filePath);
        $this->assertIsArray($content);
        $this->assertEquals(5,count($content));
        $this->assertInstanceOf(WineModel::class,$content[0]);
    }
}