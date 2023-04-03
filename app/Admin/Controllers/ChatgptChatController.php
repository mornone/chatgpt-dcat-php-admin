<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Controllers;

use App\Constant\UserConfig;
use App\Enums\ChatgptApiRequestLogType;
use App\Models\ChatgptApiRequestLog;
use App\Services\OpenAiProxyService;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * 聊天
 * Class ChatgptChatController.
 */
class ChatgptChatController extends AdminController
{
    protected $view = 'admin.chat.chat';

//    /**
//     * 发送消息.
//     */
//    public function process(Request $request): void
//    {
//        header('Content-Type: application/octet-stream');
//        header('Cache-Control: no-cache');
//        header('X-Accel-Buffering: no');
//        ob_implicit_flush(true);
//        ob_end_flush(); // 关闭缓存
//        $prompt = $request->input('prompt');
//        $options = $request->input('options');
//        $requestUid = $request->input('request_uid');
//        try {
//            $echoData['role'] = 'assistant';
//            $echoData['parentMessageId'] = $options['parentMessageId'] ?? '';
//            $echoData['conversationId'] = $options['conversationId'] ?? '';
//            if (empty($prompt)) {
//                echo json_encode(['message' => '请输入您想要咨询的问题'], 256);
//                return;
//            }
//            if (empty($requestUid)) {
//                echo json_encode(['message' => '您无权限使用该服务，请刷新页面后重试，如果还是不行，请联系程序处理'], 256);
//                return;
//            }
//            $userToken = (int) Cache::get(sprintf(UserConfig::MAX_TOKENS_USERID, $requestUid));
//            $url = Cache::get(sprintf(UserConfig::PROXY_DOMAIN, $requestUid));
//            if (empty($url)) {
//                $url = 'https://api.openai.com';
//            }
//            $open_ai = new OpenAiProxyService(config('chatgpt.key'), '', $url);
//
//            $opts = [
//                'prompt' => $prompt,
//                'temperature' => 0, // 温度
//                'max_tokens' => ! empty($userToken) ? $userToken : 2048,
//                'frequency_penalty' => 0,
//                'presence_penalty' => 0,
//                'stream' => true, // true流式
//                'model' => 'text-davinci-003', // 模式
//                //            'echo' => true,
//                'best_of' => 1, // 是否保持回声
//                'stop' => [' Human:', ' AI:'],
//                'user' => $requestUid,
//            ];
//
//            $msg = ''; // 消息
//            $number = 0; // 数量
//            $msgGroup = []; // 消息组
//
//            $result = $open_ai->completion($opts, function ($curl_info, $data) use ($options, $opts, $requestUid, &$msg, &$number, &$msgGroup) {
//                ++$number;
//                $errData = json_decode($data, true);
//                if (! empty($errData['error']['message'])) {
//                    echo json_encode(['message' => $errData['error']['message']]);
//                    exit;
//                }
//                $lastData = explode('data: ', $data);
//                if (empty($lastData[1])) {
//                    return strlen($data);
//                }
//
//                $endData = json_decode($lastData[1], true);
//                if (empty($endData['choices'][0])) {
//                    return strlen($data);
//                }
//
//                if ($number !== 1) {
//                    $msg .= $endData['choices'][0]['text'] ?? '';
//                }
//
//                $echoData['role'] = 'assistant';
//                $echoData['id'] = $endData['id'];
//                $echoData['parentMessageId'] = $options['parentMessageId'] ?? '';
//                $echoData['conversationId'] = $options['conversationId'] ?? '';
//                $echoData['text'] = $msg;
//                $echoData['detail'] = $endData;
//                $echoData['detail']['choices'][0]['text'] = $msg;
//
//                $msgGroup[] = $echoData;
//                $jsonData = json_encode($echoData, 256);
//
//                log::info('聊天请求用户:' . $requestUid . '消息:' . json_encode($opts, 256) . '回复:' . $jsonData);
//                echo $jsonData;
    // //                ob_flush();
//                flush();
//                return strlen($data);
//            });
//
//            if (! $result) {
//                echo json_encode(['message' => '网络问题调用openai失败,请重试'], 256);
//            } else {
//                ChatgptApiRequestLog::create([
//                    'user_id' => $requestUid,
//                    'type' => ChatgptApiRequestLogType::CHAT,
//                    'request_body' => $prompt,
//                    'ask' => $msg,
//                ]);
//            }
//            return;
//        } catch (\Exception $e) {
//            $msg = '聊天请求用户:' . $requestUid . '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage();
//            log::error($msg);
//            echo json_encode(['message' => '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage()], 256);
//            return;
//        }
//    }

    /**
     * 发送消息.
     */
    public function process(Request $request): void
    {
        header('Content-Type: application/octet-stream');
        header('Cache-Control: no-cache');
        header('X-Accel-Buffering: no');
        ob_implicit_flush(true);
        ob_end_flush(); // 关闭缓存
        $prompt = $request->input('prompt');
        $options = $request->input('options');
        $requestUid = $request->input('request_uid');
        try {
            if (empty($prompt)) {
                echo json_encode(['message' => '请输入您想要咨询的问题'], 256);
                return;
            }
            if (empty($requestUid)) {
                echo json_encode(['message' => '您无权限使用该服务，请刷新页面后重试，如果还是不行，请联系程序处理'], 256);
                return;
            }
            $userToken = (int) Cache::get(sprintf(UserConfig::MAX_TOKENS_USERID, $requestUid));
            $url = Cache::get(sprintf(UserConfig::PROXY_DOMAIN, $requestUid));
            if (empty($url)) {
                $url = 'https://api.openai.com';
            }
            $openAiService = new OpenAiProxyService(config('chatgpt.key'), '', $url);
            $opts = [
                'temperature' => 0, // 温度
                'max_tokens' => ! empty($userToken) ? $userToken : 2048,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
                'stream' => true, // true流式
                'model' => 'gpt-3.5-turbo', // 模式
                //            'echo' => true,
                'stop' => [' Human:', ' AI:'],
                'user' => $requestUid,
                'messages' => [['role' => 'user', 'content' => $prompt]],
            ];

            $msg = ''; // 消息
            $number = 0; // 数量
            $msgGroup = []; // 消息组

            $result = $openAiService->chatCompletion($opts, function ($curl_info, $data) use ($opts, $requestUid, &$msg, &$number, &$msgGroup) {
                ++$number;
                $errData = json_decode($data, true);
                if (! empty($errData['error']['message'])) {
                    echo json_encode(['message' => $errData['error']['message']]);
                    return strlen($data);
                }
                $lastData = explode('data: ', $data);
                if (empty($lastData[1])) {
                    return strlen($data);
                }
                $this->getMsg($lastData, $data, $msg, $requestUid, $opts);

                return strlen($data);
            });
            if (! $result) {
                echo json_encode(['message' => '网络问题调用openai失败,请重试'], 256);
            } else {
                ChatgptApiRequestLog::create([
                    'user_id' => $requestUid,
                    'type' => ChatgptApiRequestLogType::CHAT,
                    'request_body' => $prompt,
                    'ask' => $msg,
                ]);
            }
            return;
        } catch (\Exception $e) {
            $msg = '聊天请求用户:' . $requestUid . '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage();
            log::error($msg);
            echo json_encode(['message' => '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage()], 256);
            return;
        }
    }

    // 获取信息
    public function getMsg($lastData, $data, &$msg, $requestUid, $opts)
    {
        foreach ($lastData as $key => $value) {
            if ($key == 0) {
                continue;
            }
            $endData = json_decode($value, true);
            if (empty($endData['choices'][0])) {
                continue;
            }
//                if (!empty($endData['choices'][0]['delta']['role']) || !isset($endData['choices'][0]['delta']['content'])) {
//                    continue;
//                }
            if (! isset($endData['choices'][0]['delta']['content'])) {
                continue;
            }
            if ($endData['choices'][0]['delta']['content'] == "\n\n") {
                continue;
            }
            $msg .= $endData['choices'][0]['delta']['content'] ?? '';
            $echoData['role'] = 'assistant';
            $echoData['id'] = $endData['id'];
            $echoData['parentMessageId'] = $options['parentMessageId'] ?? '';
            $echoData['text'] = $msg;
            $echoData['delta'] = $endData['choices'][0]['delta']['content'] ?? '';
            $echoData['detail'] = $endData;

            $msgGroup[] = $echoData;
            $jsonData = json_encode($echoData, 256);

            log::info('聊天请求用户:' . $requestUid . '消息:' . json_encode($opts, 256) . '回复:' . $jsonData);
            echo "\n" . $jsonData;
//            ob_flush();
            flush();
        }
    }

    /**
     * Make a grid builder.
     * @return string
     */
    protected function grid()
    {
        return Show::make()->view($this->view);
    }
}
