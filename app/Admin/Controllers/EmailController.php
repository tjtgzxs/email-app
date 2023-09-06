<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Post\Folder;
use App\Models\Email;
use Encore\Admin\Actions\Action;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Email';
    protected $description = [
        'index'  => '邮件配置列表',
        'create' => '创建邮件配置',
        'edit'   => '编辑邮件配置',
        'show'   => '邮件配置详情',
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Email());
        if(auth()->user()->id>1){
            $grid->model()->where('admin_uid',auth()->user()->id);
        }
//        $grid->model()->where('admin_uid',auth()->user()->id);
        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('email_username', __('Email username'));
        $grid->column('email_password', __('Email password'));
        $grid->column('email_host', __('Email host'));
        $grid->column('email_port', __('Email port'));
        $grid->column('tele_token', __('Tele token'));
        $grid->column('tele_chat_id', __('Tele chat id'));
        $grid->column('admin_uid',__("所属人"))->display(
            function (){
                if(empty($this->admin_uid)){
                    return "未分配人";
                }
                return $this->admin->name;
            }
        );
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->filter(function ($filter){
                $filter->like('email',__('Email'));
                if (Auth::guard('admin')->user()->id==1){
                    $filter->equal('admin_uid',__("所属人"))->select(Administrator::all()->pluck('name','id'));
                }

        });
        $grid->actions(function ($actions) {
            $actions->add(new Folder());
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
        $email=Email::findOrFail($id);
        $show = new Show($email);

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('email_username', __('Email username'));
        $show->field('email_password', __('Email password'));
        $show->field('email_host', __('Email host'));
        $show->field('email_port', __('Email port'));
        $show->field('tele_token', __('Tele token'));
        $show->field('tele_chat_id', __('Tele chat id'));
        $show->field('admin_uid', __('所属用户'))->as(function ($admin_uid){
            if(empty($admin_uid)){
                return "未分配人";
            }
            return $this->admin->name;
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
        $form = new Form(new Email());

        $form->email('email', __('Email'));
        $form->text('email_username', __('Email username'));
        $form->text('email_password', __('Email password'));
        $form->text('email_host', __('Email host'));
        $form->text('email_port', __('Email port'));
        $form->text('tele_token', __('Tele token'));
        $form->text('tele_chat_id', __('Tele chat id'));
        if(auth()->user()->id==1){
            $form->select('admin_uid',__("所属人"))->options(Administrator::all()->pluck('name','id'));
        }else{
            $form->hidden('admin_uid')->default(auth()->user()->id);
        }

        return $form;
    }
}
