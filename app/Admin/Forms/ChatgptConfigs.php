<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Forms;

use App\Constant\SystemConfig;
use App\Constant\UserConfig;
use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Cache;

/**
 * Class SystemConfigs.
 */
class ChatgptConfigs extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'chatgpt配置';

    /**
     * @return \Dcat\Admin\Http\JsonResponse
     */
    public function handle(array $input)
    {
        if (isset($input[SystemConfig::MAX_TOKENS])) {
            Cache::putMany([
                sprintf(UserConfig::MAX_TOKENS_USERID, Admin::user()->id) => (int) $input[SystemConfig::MAX_TOKENS],
                sprintf(UserConfig::PROXY_DOMAIN, Admin::user()->id) => $input[SystemConfig::PROXY_DOMAIN],
            ]);
            return $this
                ->response()
                ->success('设置成功')
                ->refresh();
        }
        return $this
            ->response()
            ->error('配置key比设置的多,请检查')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $url = Cache::get(sprintf(UserConfig::PROXY_DOMAIN, Admin::user()->id));
        $this->divider('chatgpt配置');
        $this->number(SystemConfig::MAX_TOKENS, '用来控制当前会话token令牌的数量<br>最大3900,与消耗有关')->default(2048)->value((int) Cache::get(sprintf(UserConfig::MAX_TOKENS_USERID, Admin::user()->id)))->min(0)->max(3900);
        $this->select(SystemConfig::PROXY_DOMAIN, '代理')->options([
            'https://api.openai.com' => '国外',
            'https://openapi.ssiic.com' => '国内1',
            'https://openai.sforum.cn' => '国内2',
        ])->default(! empty($url) ? $url : 'https://api.openai.com');
        $this->disableResetButton();
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function default()
    {
        return Cache::many([
            sprintf(UserConfig::MAX_TOKENS_USERID, Admin::user()->id),
            sprintf(UserConfig::PROXY_DOMAIN, Admin::user()->id),
        ]);
    }
}
