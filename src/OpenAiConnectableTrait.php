<?php

declare(strict_types=1);

namespace App;

use Orhanerday\OpenAi\OpenAi;

trait OpenAiConnectableTrait
{
    private function getOpenAi(): OpenAi
    {
        $open_ai_key = $_ENV['OPEN_AI_KEY'];

        return new OpenAi($open_ai_key);
    }
}
