<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Controllers;

use App\Admin\Repositories\ChatgptAskLibrary;
use App\Models\ChatgptApi;
use App\Models\ChatgptMode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * 问答库
 * Class ChatgptAskLibraryController.
 */
class ChatgptAskLibraryController extends AdminController
{
    /**
     * Make a grid builder.
     */
    protected function grid(): Grid
    {
        return Grid::make(new ChatgptAskLibrary(['mode', 'api']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('mode.name', admin_trans_label('modeName'));
            $grid->column('api.name', admin_trans_label('apiName'));
            $grid->column('api.url', admin_trans_label('apiUrl'));
            $grid->column('request_body');
            $grid->column('ask');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->equal('mode_id', admin_trans_field('modeId'))->select(ChatgptMode::pluck(
                    'name',
                    'id'
                ));
                $filter->equal('api_id', admin_trans_field('apiId'))->select(ChatgptApi::pluck(
                    'name',
                    'id'
                ));
                $filter->like('api.url', admin_trans_field('apiUrl'));
                $filter->like('request_body', admin_trans_field('request_body'));
                $filter->between('created_at', admin_trans_field('created_at'))->datetime();
            });
            $grid->model()->orderBy('id', 'desc');
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     */
    protected function detail($id): Show
    {
        return Show::make($id, new ChatgptAskLibrary(['mode', 'api']), function (Show $show) {
            $show->field('id');
//            $show->field('mode_id');
            $show->field('mode.name', admin_trans_label('modeName'));
//            $show->field('api_id');
            $show->field('api.name', admin_trans_field('apiName'));
            $show->field('api.url', admin_trans_field('apiUrl'));
            $show->field('request_body');
            $show->field('ask');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     */
    protected function form(): Form
    {
        return Form::make(new ChatgptAskLibrary(), function (Form $form) {
            $form->display('id');
            $form->select('api_id')->options(ChatgptApi::pluck('name', 'id'))->rules('required');
            $form->select('mode_id')->options(ChatgptMode::pluck('name', 'id'))->rules('required');
            $form->text('request_body');
            $form->text('ask');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
