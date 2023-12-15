<?php

declare(strict_types=1);

namespace App\Traits;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;

trait ValidateRequestsTrait
{
    protected function validate(Constraint $constraint, $data): array
    {
        $errors =  Validation::createValidator()->validate($data, $constraint);

        $violations = [];

        if ($errors->count()) {
            foreach ($errors as $error) {
                $violations[] = [
                    'field' => $error->getPropertyPath(),
                    'message' => $error->getMessage(),
                    'value' => $error->getInvalidValue(),
                ];
            }
        }

        return $violations;
    }
}
