<?php

declare(strict_types=1);

namespace App\Constraint;

use App\Enum\ProductMethodEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class ProductEventsConstraintFactory
{
    public static function build(): Collection
    {
        return new Collection([
            'allowExtraFields' => false,
            'allowMissingFields' => false,
            'fields' => [
                'method' => [
                    new Assert\Type('string'),
                    new Assert\NotBlank(),
                    new Assert\Choice(ProductMethodEnum::AVAILABLE_METHODS),
                ],
                'params' => [
                    new Assert\Type('array'),
                    new Assert\NotBlank(),
                ],
            ],
        ]);
    }
}
