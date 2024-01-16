<?php

declare(strict_types=1);

namespace App\Controller;

use App\OpenAiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomepageController extends AbstractController
{
    private OpenAiService $openAiService;

    public function __construct(OpenAiService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    #[Route('/')]
    public function __invoke(Request $request): Response
    {
        if (!$request->isMethod('POST')) {
            return $this->render('chat.html.twig');
        }
        $message = json_decode($request->getContent(), true)['message'];

        $output = $this->openAiService->getResponse($message);

        return new JsonResponse($output);
    }
}