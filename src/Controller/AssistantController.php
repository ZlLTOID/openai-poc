<?php

declare(strict_types=1);

namespace App\Controller;

use App\OpenAiAssistantService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AssistantController extends AbstractController
{
    private OpenAiAssistantService $openAiService;

    public function __construct(OpenAiAssistantService $openAiService)
    {
        $this->openAiService = $openAiService;
    }

    #[Route('/assistant', name: 'assistant')]
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