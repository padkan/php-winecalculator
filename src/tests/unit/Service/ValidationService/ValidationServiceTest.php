<?php
namespace Saeed\Winecalculator\tests\unit\Service\ValidationService;

use Saeed\Winecalculator\Service\ValidationService\ValidationService;
use Saeed\Winecalculator\Model\ValidationResponseModel;

class ValidationServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testValidateSuccess(): void
    {
        $validationService = new ValidationService();
        $validationResponseModel = $validationService->validate(['path' => 'src/tests/unit/helpers/data/products.json']);
        $this->assertInstanceOf(ValidationResponseModel::class, $validationResponseModel);
        $this->assertTrue($validationResponseModel->isValid());
    }

    public function testValidateFail(): void
    {
        $validationService = new ValidationService();
        $validationResponseModel = $validationService->validate(['path' => 'invalid/path']);
        $this->assertInstanceOf(ValidationResponseModel::class, $validationResponseModel);
        $this->assertFalse($validationResponseModel->isValid());
    }
}