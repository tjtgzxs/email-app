<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\ImportNickPost;
use App\Models\Email;
use App\Models\Nick;
use Encore\Admin\Auth\Database\Administrator;
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
        if(auth()->user()->id>1){
            $grid->model()->where('admin_id',auth()->user()->id);
        }
        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('nick', __('Nick'));
        $grid->column('admin_id',__("所属人"))->display(
            function (){
                if(empty($this->admin_id)){
                    return "未分配人";
                }
                return $this->admin->name;
            }
        );
        $grid->column('folder_id',__("所属文件夹"))->display(
            function (){
                if(empty($this->folder_id)){
                    return "未分配文件夹";
                }
                if (empty($this->folder)){
                    return "文件夹已删除";
                }
                return $this->folder->folder;
            }
        );
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportNickPost());
        });
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
        $show->field('admin_id', __('所属用户'))->as(function ($admin_id){
            if(empty($admin_id)){
                return "未分配人";
            }
            return $this->admin->name;
        });
        $show->field('folder_id', __('所属文件夹'))->as(function ($folder_id){
            if(empty($folder_id)){
                return "未分配文件夹";
            }
            return $this->folder->folder;
        });
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
        if(auth()->user()->id==1){
            $form->select('admin_id',__("所属人"))->options(Administrator::all()->pluck('name','id'));
            $form->select('folder_id',__("所属文件夹"))->options(\App\Models\Folder::get()->pluck('folder','id'));

        }else{
            $form->hidden('admin_id')->default(auth()->user()->id);
            $all_emails_id=Email::get()->where('admin_uid',auth()->user()->id)->pluck('id')->toArray();
            $form->select('folder_id',__("所属文件夹"))->options(\App\Models\Folder::get()->whereIn('email_id',$all_emails_id)->pluck('folder','id'));

        }

        return $form;
    }
}
