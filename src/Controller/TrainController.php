<?php

declare(strict_types=1);

namespace App\Controller;

use App\TrainAssistant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class TrainController extends AbstractController
{
    private TrainAssistant $trainAssistant;

    public function __construct(TrainAssistant $trainAssistant)
    {
        $this->trainAssistant = $trainAssistant;
    }

    #[Route('/train', name: 'train')]
    public function __invoke()
    {
        return new JsonResponse(
            $this->trainAssistant->train()
        );
    }
}