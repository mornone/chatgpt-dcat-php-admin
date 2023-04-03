<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Controllers;

use App\Admin\Repositories\ChatgptApiRequestLog;
use App\Enums\ChatgptApiRequestLogType;
use App\Enums\GetImageType;
use App\Models\ChatgptApi;
use App\Models\ChatgptMode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Show;

/**
 * 聊天请求日志
 * Class ChatgptApiRequestLogController.
 */
class ChatgptApiRequestLogController extends AdminController
{
    /**
     * Make a grid builder.
     */
    protected function grid(): Grid
    {
        return Grid::make(new ChatgptApiRequestLog(['administrator']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_id', admin_trans_label('userId'));
            $grid->column('administrator.name', admin_trans_label('userName'));
            /*            $grid->column('mode.name', admin_trans_label('modeName'));
                        $grid->column('api.name', admin_trans_label('apiName'));
                        $grid->column('api.url', admin_trans_label('apiUrl'));*/
            $grid->column('type')->using(ChatgptApiRequestLogType::asSelectArray(), '未知');
            $grid->column('request_body')->display(function () {
                switch ($this->type) {
                    case ChatgptApiRequestLogType::IMAGE_CREATE:
                        $requestBody = json_decode($this->request_body, true);
                        return '内容：<b>' . $requestBody['prompt'] . '</b></br>图片大小：<b>' . $requestBody['size'] . '</b></br>图片张数：<b>' . $requestBody['n'] . '</b>';
                    case ChatgptApiRequestLogType::IMAGE_EDIT:
                        $requestBody = json_decode($this->request_body, true);
                        $requestBody['image'] = getImage(GetImageType::URL, $requestBody['image']);
                        if (! empty($requestBody['mask'])) {
                            $requestBody['mask'] = getImage(GetImageType::URL, $requestBody['mask']);
                        }
                        return '内容：<b>' . $requestBody['prompt'] . '</b></br>图片大小：<b>' . $requestBody['size'] . '</b></br>图片张数：<b>' . $requestBody['n'] . '</b></br>主图：' . $requestBody['image'] . '</br>参考图：' . $requestBody['mask'];
                    case ChatgptApiRequestLogType::IMAGE_VARIATION:
                        $requestBody = json_decode($this->request_body, true);
                        $requestBody['image'] = getImage(GetImageType::URL, $requestBody['image']);
                        return '</b></br>图片大小：<b>' . $requestBody['size'] . '</b></br>图片张数：<b>' . $requestBody['n'] . '</b></br>主图：' . $requestBody['image'];
                    default:
                        return $this->request_body;
                }
            });
            $grid->column('ask')->display(function () {
                switch ($this->type) {
                    case ChatgptApiRequestLogType::IMAGE_CREATE:
                    case ChatgptApiRequestLogType::IMAGE_EDIT:
                    case ChatgptApiRequestLogType::IMAGE_VARIATION:
                        $imgArr = json_decode($this->ask, true);
                        $msg = '';
                        foreach ($imgArr as $img) {
                            $msg .= getImage(GetImageType::BASE64, $img['b64_json']);
                        }
                        return $msg;
                    default:
                        return $this->ask;
                }
            });
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('user_id', admin_trans_field('userId'))->select(Administrator::pluck(
                    'name',
                    'id'
                ));
//                $filter->equal('mode_id', admin_trans_field('modeId'))->select(ChatgptMode::pluck(
//                    'name',
//                    'id'
//                ));
//                $filter->equal('api_id', admin_trans_field('apiId'))->select(ChatgptApi::pluck(
//                    'name',
//                    'id'
//                ));
//                $filter->like('api.url', admin_trans_field('apiUrl'));
                $filter->like('equal', admin_trans_field('type'))->select(ChatgptApiRequestLogType::asSelectArray());
                $filter->like('request_body', admin_trans_field('request_body'));
                $filter->between('created_at', admin_trans_field('created_at'))->datetime();
            });
            $grid->model()->orderBy('id', 'desc');
            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     */
    protected function detail($id): Show
    {
        return Show::make($id, new ChatgptApiRequestLog(['administrator']), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
//            $show->field('administrator.name', admin_trans_label('userName'));
//            $show->field('mode_id');
//            $show->field('mode.name', admin_trans_label('modeName'));
//            $show->field('api_id');
//            $show->field('api.name', admin_trans_field('apiName'));
//            $show->field('api.url', admin_trans_field('apiUrl'));
            $show->field('type', admin_trans_field('type'));
            $show->field('request_body');
            $show->field('ask');
            $show->field('created_at');
            $show->field('updated_at');
            $show->disableDeleteButton();
            $show->disableEditButton();
        });
    }

    /**
     * Make a form builder.
     */
    protected function form(): Form
    {
        return Form::make(new ChatgptApiRequestLog(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('mode_id');
            $form->text('api_id');
            $form->text('request_body');
            $form->text('ask');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
