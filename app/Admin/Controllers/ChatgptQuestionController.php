<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Admin\Controllers;

use App\Admin\Repositories\ChatgptQuestion;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class ChatgptQuestionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ChatgptQuestion(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('question');
            $grid->column('ask');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('question');
                $filter->like('ask');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new ChatgptQuestion(), function (Show $show) {
            $show->field('id');
            $show->field('question');
            $show->field('ask');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new ChatgptQuestion(), function (Form $form) {
            $form->display('id');
            $form->text('question');
            $form->text('ask');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
