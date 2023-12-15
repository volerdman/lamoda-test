<?php

declare(strict_types=1);

namespace App\Service;

use App\Constraint\CancelProductReservationConstraintFactory;
use App\Constraint\ReserveProductsInStorageConstraintFactory;
use App\Repository\ProductRepository;
use App\Traits\ValidateRequestsTrait;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;

class ProductService
{
    use ValidateRequestsTrait;

    private LoggerInterface $logger;
    private ProductRepository $repository;

    public function __construct(LoggerInterface $logger, ProductRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    public function reserveProducts(array $params): array
    {
        $violations = $this->validate(
            ReserveProductsInStorageConstraintFactory::build(),
            $params
        );

        if (!empty($violations)) {
            $this->logger->error('Data has invalid parameters', $violations);

            throw new InvalidArgumentException(json_encode($violations, JSON_PRETTY_PRINT));
        }

        return ['updated_products' => $this->repository->reserveProductsByCodes($params['code'])];
    }

    public function cancelProductsReservation(array $params): array
    {
        $violations = $this->validate(
            CancelProductReservationConstraintFactory::build(),
            $params
        );

        if (!empty($violations)) {
            $this->logger->error('Data has invalid parameters', $violations);

            throw new InvalidArgumentException(json_encode(($violations), JSON_PRETTY_PRINT));
        }

        return ['updated_products' => $this->repository->cancelReservationProductsByCodes($params['code'])];
    }
}
