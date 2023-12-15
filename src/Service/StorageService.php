<?php

declare(strict_types=1);

namespace App\Service;

use App\Constraint\GetProductInStorageConstraintFactory;
use App\Constraint\StorageEventsConstraintFactory;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Traits\ValidateRequestsTrait;
use Fig\Http\Message\StatusCodeInterface;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class StorageService
{
    use ValidateRequestsTrait;

    private LoggerInterface $logger;
    private ProductRepository $repository;

    public function __construct(LoggerInterface $logger, ProductRepository $repository)
    {
        $this->logger = $logger;
        $this->repository = $repository;
    }

    public function getProductsInStorage(array $params): array
    {
        $violations = $this->validate(
            GetProductInStorageConstraintFactory::build(),
            $params
        );
        if (!empty($violations)) {
            $this->logger->error('Data has invalid parameters', $violations);

            throw new InvalidArgumentException(json_encode($violations, JSON_PRETTY_PRINT));
        }

        $productsInStorage = $this->repository->findByStorageId((int)$params['id']);
        $totalCount = 0;
        if (!empty($productsInStorage)) {
            /** @var Product $product */
            foreach ($productsInStorage as $product) {
                $totalCount += $product->getCount();
            }
        }

        return ['total_products_count' => $totalCount];
    }
}
