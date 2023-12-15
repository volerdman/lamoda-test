<?php

declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class ReserveProductsInStorageConstraintFactory
{
    public static function build(): Collection
    {
        return new Collection([
            'allowExtraFields' => false,
            'allowMissingFields' => false,
            'fields' => [
                'code' => [
                    new Assert\Type('array'),
                    new Assert\NotBlank(),
                ],
            ],
        ]);
    }
}
