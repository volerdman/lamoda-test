<?php

declare(strict_types=1);

namespace App\Enum;

final class ProductMethodEnum
{
    public const RESERVE_PRODUCTS = 'reserveProducts';
    public const CANCEL_PRODUCTS_RESERVATION = 'cancelProductsReservation';
    public const AVAILABLE_METHODS = [
        self::RESERVE_PRODUCTS,
        self::CANCEL_PRODUCTS_RESERVATION,
    ];
}
