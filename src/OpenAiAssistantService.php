<?php

declare(strict_types=1);

namespace App;


use OpenAI\Responses\Assistants\AssistantResponse;
use Orhanerday\OpenAi\OpenAi;

final class OpenAiAssistantService
{
    public function getResponse(string $input): AssistantResponse
    {
        $client = \OpenAI::client($_ENV['OPEN_AI_KEY']);

        $response = $client->assistants()->retrieve('asst_PDVqUy5cjbXYkPyOsZ9XP4ut');

        dd($client->threads());
        $thread = $client->threads()->retrieve('thread_h99Q1b2vk3os7wW9Pbm8Womr');
        dd($client->threads()->messages()->list('thread_h99Q1b2vk3os7wW9Pbm8Womr'));
        return $response;
    }
}
