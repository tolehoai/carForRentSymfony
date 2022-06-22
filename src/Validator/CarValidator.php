<?php

namespace App\Validator;

use App\Request\ListCarRequest;
use App\Traits\ResponseTrait;
use App\Traits\TransferTrait;
use http\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CarValidator
{
    use TransferTrait;
    use ResponseTrait;
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validatorCarRequest(mixed $param): array
    {
        $errors = $this->validator->validate($param);
        if (count($errors) >= 1) {
            return $this->errorToArray($errors);
//            throw new ValidatorException('ValidatorException', code: Response::HTTP_BAD_REQUEST);
        }
        return [];
    }
}
