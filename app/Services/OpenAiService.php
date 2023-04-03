<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Services;

use Orhanerday\OpenAi\Url;

class OpenAiService
{
    public string $customUrl = '';

    protected string $model = 'text-davinci-002';

    protected object $stream_method;

    private string $engine = 'davinci';

    private array $headers;

    private array $contentTypes;

    private int $timeout = 0;

    public function __construct($OPENAI_API_KEY, $OPENAI_ORG = '', $customUrl = '')
    {
        $this->contentTypes = [
            'application/json' => 'Content-Type: application/json',
            'multipart/form-data' => 'Content-Type: multipart/form-data',
        ];

        $this->headers = [
            $this->contentTypes['application/json'],
            "Authorization: Bearer {$OPENAI_API_KEY}",
        ];

        if ($OPENAI_ORG != '') {
            $this->headers[] = "OpenAI-Organization: {$OPENAI_ORG}";
        }
        if ($customUrl != '') {
            $this->customUrl = $customUrl;
        }
    }

    /**
     * @return bool|string
     */
    public function listModels()
    {
        $url = Url::fineTuneModel();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $model
     * @return bool|string
     */
    public function retrieveModel($model)
    {
        $model = "/{$model}";
        $url = Url::fineTuneModel() . $model;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @deprecated
     * @param mixed $opts
     * @return bool|string
     */
    public function complete($opts)
    {
        $engine = $opts['engine'] ?? $this->engine;
        $url = Url::completionURL($engine);
        unset($opts['engine']);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param null $stream
     * @param mixed $opts
     * @return bool|string
     * @throws \Exception
     */
    public function completion($opts, $stream = null)
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
        $url = Url::completionsURL();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function createEdit($opts)
    {
        $url = Url::editsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function image($opts)
    {
        $url = Url::imageUrl() . '/generations';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function imageEdit($opts)
    {
        $url = Url::imageUrl() . '/edits';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function createImageVariation($opts)
    {
        $url = Url::imageUrl() . '/variations';
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @deprecated
     * @param mixed $opts
     * @return bool|string
     */
    public function search($opts)
    {
        $engine = $opts['engine'] ?? $this->engine;
        $url = Url::searchURL($engine);
        unset($opts['engine']);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @deprecated
     * @param mixed $opts
     * @return bool|string
     */
    public function answer($opts)
    {
        $url = Url::answersUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @deprecated
     * @param mixed $opts
     * @return bool|string
     */
    public function classification($opts)
    {
        $url = Url::classificationsUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function moderation($opts)
    {
        $url = Url::moderationUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function uploadFile($opts)
    {
        $url = Url::filesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @return bool|string
     */
    public function listFiles()
    {
        $url = Url::filesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $file_id
     * @return bool|string
     */
    public function retrieveFile($file_id)
    {
        $file_id = "/{$file_id}";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $file_id
     * @return bool|string
     */
    public function retrieveFileContent($file_id)
    {
        $file_id = "/{$file_id}/content";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $file_id
     * @return bool|string
     */
    public function deleteFile($file_id)
    {
        $file_id = "/{$file_id}";
        $url = Url::filesUrl() . $file_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function createFineTune($opts)
    {
        $url = Url::fineTuneUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    /**
     * @return bool|string
     */
    public function listFineTunes()
    {
        $url = Url::fineTuneUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $fine_tune_id
     * @return bool|string
     */
    public function retrieveFineTune($fine_tune_id)
    {
        $fine_tune_id = "/{$fine_tune_id}";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $fine_tune_id
     * @return bool|string
     */
    public function cancelFineTune($fine_tune_id)
    {
        $fine_tune_id = "/{$fine_tune_id}/cancel";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST');
    }

    /**
     * @param mixed $fine_tune_id
     * @return bool|string
     */
    public function listFineTuneEvents($fine_tune_id)
    {
        $fine_tune_id = "/{$fine_tune_id}/events";
        $url = Url::fineTuneUrl() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $fine_tune_id
     * @return bool|string
     */
    public function deleteFineTune($fine_tune_id)
    {
        $fine_tune_id = "/{$fine_tune_id}";
        $url = Url::fineTuneModel() . $fine_tune_id;
        $this->baseUrl($url);

        return $this->sendRequest($url, 'DELETE');
    }

    /**
     * @return bool|string
     * @deprecated
     */
    public function engines()
    {
        $url = Url::enginesUrl();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @deprecated
     * @param mixed $engine
     * @return bool|string
     */
    public function engine($engine)
    {
        $url = Url::engineUrl($engine);
        $this->baseUrl($url);

        return $this->sendRequest($url, 'GET');
    }

    /**
     * @param mixed $opts
     * @return bool|string
     */
    public function embeddings($opts)
    {
        $url = Url::embeddings();
        $this->baseUrl($url);

        return $this->sendRequest($url, 'POST', $opts);
    }

    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return bool|string
     */
    protected function sendRequest(string $url, string $method, array $opts = [])
    {
        $post_fields = json_encode($opts);

        if (array_key_exists('file', $opts) || array_key_exists('image', $opts)) {
            $this->headers[0] = $this->contentTypes['multipart/form-data'];
            $post_fields = $opts;
        } else {
            $this->headers[0] = $this->contentTypes['application/json'];
        }
        $curl_info = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => $this->headers,
        ];

        if ($opts == []) {
            unset($curl_info[CURLOPT_POSTFIELDS]);
        }

        if (array_key_exists('stream', $opts) && $opts['stream']) {
            $curl_info[CURLOPT_WRITEFUNCTION] = $this->stream_method;
        }

        $curl = curl_init();

        curl_setopt_array($curl, $curl_info);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    protected function baseUrl(string &$url)
    {
        if ($this->customUrl != '') {
            $url = str_replace(Url::ORIGIN, $this->customUrl, $url);
        }
    }
}
