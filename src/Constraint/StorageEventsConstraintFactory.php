<?php

declare(strict_types=1);

namespace App\Constraint;

use App\Enum\StorageMethodsEnum;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;

class StorageEventsConstraintFactory
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
                    new Assert\Choice(StorageMethodsEnum::AVAILABLE_METHODS),
                ],
                'params' => [
                    new Assert\Type('array'),
                    new Assert\NotBlank(),
                ],
            ],
        ]);
    }
}
