<?php

declare(strict_types=1);

namespace App\Enum;

final class StorageMethodsEnum
{
    public const PRODUCT_LIST_IN_STORAGE = 'getProductsInStorage';

    public const AVAILABLE_METHODS = [
        self::PRODUCT_LIST_IN_STORAGE,
    ];
}
