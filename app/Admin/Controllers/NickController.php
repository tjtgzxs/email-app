<?php

namespace App\Admin\Controllers;

use App\Models\Nick;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NickController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nick';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Nick());

        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('nick', __('Nick'));
        $grid->column('admin_id', __('Admin id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Nick::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('nick', __('Nick'));
        $show->field('admin_id', __('Admin id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Nick());

        $form->email('email', __('Email'));
        $form->text('nick', __('Nick'));
        $form->number('admin_id', __('Admin id'))->default(1);

        return $form;
    }
}
