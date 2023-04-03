<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Controllers;

use App\Admin\Repositories\ChatgptApi;
use App\Enums\ChatgptApiStatus;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * api
 * Class ChatgptApiController.
 */
class ChatgptApiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Api列表';

    /**
     * Make a grid builder.
     */
    protected function grid(): Grid
    {
        return Grid::make(new ChatgptApi(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name')->editable(true);
            $grid->column('url')->editable(true);
            $grid->column('status')->switch('', true);
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id', admin_trans_field('id'));
                $filter->equal('status', admin_trans_field('status'))->select(ChatgptApiStatus::asSelectArray());
                $filter->like('name', admin_trans_field('name'));
                $filter->like('url', admin_trans_field('url'));
                $filter->between('created_at', admin_trans_field('created_at'))->datetime();
            });
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
        return Show::make($id, new ChatgptApi(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('url');
            $show->field('status')->using(ChatgptApiStatus::asSelectArray(), '未知');
            $show->field('created_at');
            $show->field('updated_at');
            $show->disableDeleteButton();
        });
    }

    /**
     * Make a form builder.
     */
    protected function form(): Form
    {
        return Form::make(new ChatgptApi(), function (Form $form) {
            $form->display('id');
            $form->text('name')->rules('required');
            $form->text('url')->rules('required');
            $form->select('status', admin_trans_field('status'))->options(ChatgptApiStatus::asSelectArray())->default(ChatgptApiStatus::ON)->rules('required');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
