<?php

namespace App\Validator;

use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ImageValidator
{
    use TransferTrait;
    use ResponseTrait;

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validatorImageRequest(mixed $param): array
    {
        $errors = $this->validator->validate($param);
        if (count($errors) >= 1) {
            return $this->errorToArray($errors);
        }

        return [];
    }
}
