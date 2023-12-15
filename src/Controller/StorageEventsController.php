<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constraint\StorageEventsConstraintFactory;
use App\Service\StorageService;
use App\Traits\ValidateRequestsTrait;
use Fig\Http\Message\StatusCodeInterface;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorageEventsController extends BaseController
{
    use ValidateRequestsTrait;

    private StorageService $service;

    public function __construct(LoggerInterface $logger, StorageService $service)
    {
        $this->service = $service;
        parent::__construct($logger);
    }

    public function handleStorageEvents(Request $request): Response
    {
        $this->logger->info('Got connection storage event');

        try {
            $content = $request->getContent();
            $data = (array)$this->validateRequestData($content);
        } catch (InvalidArgumentException $e) {
            $this->logger->error($e->getMessage(), ['request' => $request->getContent()]);
            return new Response($e->getMessage(), StatusCodeInterface::STATUS_BAD_REQUEST);
        }

        $violations = $this->validate(
            StorageEventsConstraintFactory::build(),
            $data
        );
        if (!empty($violations)) {
            $this->logger->error('Data has invalid parameters', $violations);
            return new JsonResponse(
                $violations,
                StatusCodeInterface::STATUS_BAD_REQUEST
            );
        }

        try {
            $result = $this->service->{$data['method']}($data['params']);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse($e->getMessage());
        }

        return new JsonResponse(['result' => $result]);
    }
}
