<?php

declare(strict_types=1);

namespace App\Controller;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    protected function validateRequestData($data)
    {
        if (empty($data)) {
            $this->logger->error('Data not found for parse');
            throw new InvalidArgumentException('Empty data');
        }

        $data = json_decode($data, true);
        if (!$data) {
            $this->logger->error('Data not found for parse');
            throw new InvalidArgumentException('Bad request');
        }

        return $data;
    }
}
