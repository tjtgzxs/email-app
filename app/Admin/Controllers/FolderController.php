<?php

namespace App\Admin\Controllers;

use App\Models\Folder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Middleware\Session;
use Encore\Admin\Show;
use http\Env\Request;

class FolderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Folder';
    private $_email_id;
    /**
     * Make a grid builder.
     *
     * @return Grid
     */



    protected function grid()
    {
        $grid = new Grid(new Folder());
        $email_id = request()->get('email_id');
        if(!empty($email_id)){
            \Illuminate\Support\Facades\Session::put('email_id', $email_id);
            $grid->model()->where('email_id',$email_id);
        }

//        $grid->model()->where('email_id',$email_id);
        $grid->column('id', __('Id'));
        $grid->column('email_id', __('Email id'));
        $grid->column('folder', __('Folder'));
        $grid->column('from', __('From'));
        $grid->column('analyze', __('Analyze'));
        $grid->column('continue', __('Continue'));
        $grid->column('to', __('To'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

//        $grid->getCreateUrl();
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

        $show = new Show(Folder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email_id', __('Email id'));
        $show->field('folder', __('Folder'));
        $show->field('from', __('From'));
        $show->field('analyze', __('Analyze'));
        $show->field('continue', __('Continue'));
        $show->field('to', __('To'));
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
        $email_id=\Illuminate\Support\Facades\Session::get('email_id');
        $form = new Form(new Folder(),function (Form $form)use($email_id){
            $form->hidden('email_id', __('Email id'))->default($email_id);
        });
        $form->text('folder', __('Folder'));
        $form->text('from', __('From'));
        $form->text('analyze', __('Analyze'));
        $form->text('continue', __('Continue'));
        $form->text('to', __('To'));

        return $form;
    }
}
