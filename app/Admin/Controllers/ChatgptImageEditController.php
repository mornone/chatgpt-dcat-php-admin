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
 * 编辑图片
 * Class ChatgptImageEditController.
 */
class ChatgptImageEditController extends AdminController
{
    protected $view = 'admin.chat.image_edit';

    /**
     * 生成图片.
     */
    public function process(Request $request): void
    {
        $prompt = $request->input('prompt');
        $size = $request->input('size');
        $n = $request->input('n');
        $requestUid = $request->input('request_uid');
        $image = $request->file('image');
        $mask = $request->file('mask');
        try {
            if (empty($prompt)) {
                echo json_encode(['msg' => '请输入您对照片的描述', 'created' => time(), 'data' => []], 256);
                return;
            }
            if (empty($requestUid)) {
                echo json_encode(['msg' => '您无权限使用该服务，请刷新页面后重试，如果还是不行，请联系程序处理', 'created' => time(), 'data' => []], 256);
                return;
            }
            if (! $request->hasFile('image') || ! $image->isValid() || $image->extension() != 'png') {
                echo json_encode(['msg' => '请上传正确的图片', 'created' => time(), 'data' => []], 256);
                return;
            }
            if ($request->hasFile('image') && ! $image->isValid()) {
                echo json_encode(['msg' => '请上传图片', 'created' => time(), 'data' => []], 256);
                return;
            }
            if (($request->hasFile('mask') && ! $mask->isValid()) || ($request->hasFile('mask') && $mask->extension() != 'png')) {
                echo json_encode(['msg' => '请上传正确的图片', 'created' => time(), 'data' => []], 256);
                return;
            }

            $imageExt = $image->extension();
            $newImageFileName = md5(date('Y-m-d H:i:s') . $image->getFilename()) . '.' . $imageExt;
            $imagePath = $image->move(storage_path('app/public/uploads/images/' . date('Y-m-d')), $newImageFileName);

            $requestImage = curl_file_create($imagePath->getPathname());

            if ($request->hasFile('mask') && $mask->isValid()) {
                $maskExt = $mask->extension();
                $newMaskFileName = md5(date('Y-m-d H:i:s') . $mask->getFilename()) . '.' . $maskExt;
                $maskPath = $mask->move(storage_path('app/public/uploads/images/' . date('Y-m-d')), $newMaskFileName);
                $requestMask = curl_file_create($maskPath->getPathname());
            }
            $url = Cache::get(sprintf(UserConfig::PROXY_DOMAIN, $requestUid));
            if (empty($url)) {
                $url = 'https://api.openai.com';
            }
            $open_ai = new OpenAiProxyService(config('chatgpt.key'), '', $url);
            $opts = [
                'prompt' => $prompt,
                'image' => $requestImage,
                'mask' => $requestMask ?? '',
                'size' => $size,
                'n' => (int) $n,
                'user' => (string) $requestUid,
                'response_format' => 'b64_json',
            ];
            $data = $open_ai->imageEdit($opts);

            if (! empty($data)) {
                log::info('编辑图片请求用户:' . $requestUid . '消息:' . json_encode($opts, 256) . '回复:' . $data);
                $dataArr = json_decode($data, true);
                if (! empty($dataArr['error']['message'])) {
                    echo json_encode(['msg' => $dataArr['error']['message']]);
                    return;
                }
                $dataArr['msg'] = '生成成功';
                ChatgptApiRequestLog::create([
                    'user_id' => $requestUid,
                    'type' => ChatgptApiRequestLogType::IMAGE_EDIT,
                    'request_body' => json_encode([
                        'prompt' => $prompt,
                        'image' => ! empty($imagePath) ? ('storage/uploads/images/' . date('Y-m-d') . '/' . $newImageFileName) : '',
                        'mask' => ! empty($maskPath) ? ('storage/uploads/images/' . date('Y-m-d') . '/' . $newMaskFileName ?? '') : '',
                        'size' => $size,
                        'n' => (int) $n,
                        'user' => (string) $requestUid,
                        'response_format' => 'b64_json',
                    ], 256),
                    'ask' => json_encode($dataArr['data'], 256),
                ]);
                echo json_encode($dataArr, 256);
            }
            if (! $data) {
                echo json_encode(['msg' => '网络问题调用openai失败', 'created' => time(), 'data' => []], 256);
            }
            return;
        } catch (\Exception $e) {
            log::error('编辑图片请求用户:' . $requestUid . '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage());
            echo json_encode(['message' => '出现异常文件：' . $e->getFile() . '。行号:' . $e->getLine() . '。错误:' . $e->getMessage()], 256);
            return;
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
