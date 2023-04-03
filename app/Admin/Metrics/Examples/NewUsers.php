<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;

class NewUsers extends Line
{
    /**
     * 处理请求
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $generator = function ($len, $min = 10, $max = 300) {
            for ($i = 0; $i <= $len; ++$i) {
                yield mt_rand($min, $max);
            }
        };

        switch ($request->get('option')) {
            case '365':
                // 卡片内容
                $this->withContent(mt_rand(1000, 5000) . 'k');
                // 图表数据
                $this->withChart(collect($generator(30))->toArray());
                break;
            case '30':
                // 卡片内容
                $this->withContent(mt_rand(400, 1000) . 'k');
                // 图表数据
                $this->withChart(collect($generator(30))->toArray());
                break;
            case '28':
                // 卡片内容
                $this->withContent(mt_rand(400, 1000) . 'k');
                // 图表数据
                $this->withChart(collect($generator(28))->toArray());
                break;
            case '7':
            default:
                // 卡片内容
                $this->withContent('89.2k');
                // 图表数据
                $this->withChart([28, 40, 36, 52, 38, 60, 55]);
        }
    }

    /**
     * 设置图表数据.
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => $this->title,
                    'data' => $data,
                ],
            ],
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-lg-1">{$content}</h2>
    <span class="mb-0 mr-1 text-80">{$this->title}</span>
</div>
HTML
        );
    }

    /**
     * 初始化卡片内容.
     */
    protected function init()
    {
        parent::init();

        $this->title('New Users');
        $this->dropdown([
            '7' => 'Last 7 Days',
            '28' => 'Last 28 Days',
            '30' => 'Last Month',
            '365' => 'Last Year',
        ]);
    }
}
