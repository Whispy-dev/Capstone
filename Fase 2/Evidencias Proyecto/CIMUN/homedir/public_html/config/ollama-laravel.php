<?php

// Config for Cloudstudio/Ollama

return [
    'model' => env('OLLAMA_MODEL', 'ollama.com/library/llama3.2:latest'),
    'url' => env('OLLAMA_URL', 'http://apivollama.virtual.brouter.cl'),
    'default_prompt' => env('OLLAMA_DEFAULT_PROMPT', 'Hola, ¿cómo puedo ayudarle hoy?'),
    'connection' => [
        'timeout' => env('OLLAMA_CONNECTION_TIMEOUT', 300),
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . env('OLLAMA_API_KEY'),
    ],
];
