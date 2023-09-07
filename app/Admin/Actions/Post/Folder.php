<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Folder extends RowAction
{
    public $name = '邮件文件夹';

    /**
     * @return  string
     */
    public function href()
    {
        return "/admin/folders"."?email_id=".$this->getKey();
//        return "www.baidu.com";
    }

}
