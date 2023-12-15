<?php

declare(strict_types=1);

namespace App\Constraint;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class GetProductInStorageConstraintFactory
{
    public static function build(): Collection
    {
        return new Collection([
            'allowExtraFields' => false,
            'allowMissingFields' => false,
            'fields' => [
                'id' => [
                    new Assert\Type('integer'),
                    new Assert\NotBlank(),
                    new Assert\Positive(),
                ],
            ],
        ]);
    }
}
