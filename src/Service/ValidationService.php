<?php

declare(strict_types=1);

namespace Saeed\Winecalculator\Service;

use Saeed\Winecalculator\Model\ValidationResponseModel;

class ValidationService implements ValidateInterface
{
    public function validate(array $data): ValidationResponseModel
    {
        return $this->validaFilePath($data['path']);
    }

    private function validaFilePath(string $filePath): ValidationResponseModel
    {
        try {
            $realPath = realpath($filePath);

            if ($realPath === false) {
                return new ValidationResponseModel(false, '');
            }

            $fileExists = file_exists($realPath);
            if (!$fileExists) {
                return new ValidationResponseModel(false, '');
            }

            return new ValidationResponseModel(true, $realPath);
        } catch (\Throwable) {
            return new ValidationResponseModel(false, '');
        }
    }
}