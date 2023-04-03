<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Metrics\Bar;
use Illuminate\Http\Request;

class Sessions extends Bar
{
    /**
     * 处理请求
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        switch ($request->get('option')) {
            case '7':
            default:
                // 卡片内容
                $this->withContent('2.7k', '+5.2%');

                // 图表数据
                $this->withChart([
                    [
                        'name' => 'Sessions',
                        'data' => [75, 125, 225, 175, 125, 75, 25],
                    ],
                ]);
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
            'series' => $data,
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $title
     * @param string $value
     * @param string $style
     *
     * @return $this
     */
    public function withContent($title, $value, $style = 'success')
    {
        // 根据选项显示
        $label = strtolower(
            $this->dropdown[request()->option] ?? 'last 7 days'
        );

        $minHeight = '183px';

        return $this->content(
            <<<HTML
<div class="d-flex p-1 flex-column justify-content-between" style="padding-top: 0;width: 100%;height: 100%;min-height: {$minHeight}">
    <div class="text-left">
        <h1 class="font-lg-2 mt-2 mb-0">{$title}</h1>
        <h5 class="font-medium-2" style="margin-top: 10px;">
            <span class="text-{$style}">{$value} </span>
            <span>vs {$label}</span>
        </h5>
    </div>

    <a href="#" class="btn btn-primary shadow waves-effect waves-light">View Details <i class="feather icon-chevrons-right"></i></a>
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

        $color = Admin::color();

        $dark35 = $color->dark35();

        // 卡片内容宽度
        $this->contentWidth(5, 7);
        // 标题
        $this->title('Avg Sessions');
        // 设置下拉选项
        $this->dropdown([
            '7' => 'Last 7 Days',
            '28' => 'Last 28 Days',
            '30' => 'Last Month',
            '365' => 'Last Year',
        ]);
        // 设置图表颜色
        $this->chartColors([
            $dark35,
            $dark35,
            $color->primary(),
            $dark35,
            $dark35,
            $dark35,
        ]);
    }
}
