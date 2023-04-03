<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Services;

use Orhanerday\OpenAi\Url;

/**
 * 代理扩展chatgpt3.5版本
 * Class OpenAiProxyService.
 */
class OpenAiProxyService extends OpenAiService
{
    public string $url;

    /**
     * OpenAiProxyService constructor.
     * @param string $OPENAI_ORG
     * @param string $customUrl
     * @param mixed $OPENAI_API_KEY
     */
    public function __construct($OPENAI_API_KEY, $OPENAI_ORG = '', $customUrl = '')
    {
        parent::__construct($OPENAI_API_KEY, $OPENAI_ORG, $customUrl);
    }

    /**
     * 扩展.
     * @param null $stream
     * @param mixed $opts
     * @return bool|string
     * @throws \Exception
     */
    public function chatCompletion($opts, $stream = null)
    {
        if ($stream != null && array_key_exists('stream', $opts)) {
            if (! $opts['stream']) {
                throw new \Exception(
                    'Please provide a stream function. Check https://github.com/orhanerday/open-ai#stream-example for an example.'
                );
            }

            $this->stream_method = $stream;
        }

        $opts['model'] = $opts['model'] ?? $this->model;
        $url = Url::OPEN_AI_URL . '/chat/completions';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }
}
