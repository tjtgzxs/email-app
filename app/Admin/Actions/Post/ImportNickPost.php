<?php

namespace App\Admin\Actions\Post;

use App\Models\Nick;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class ImportNickPost extends Action
{
    public $name = '导入昵称数据';
    protected $selector = '.import-nick-post';

    public function handle(Request $request)
    {
        // $request ...
        $file=$request->file('file');
        //读取csv
        $file = fopen($file->getRealPath(),'r');
        $data=[];
        while ($datafile = fgetcsv($file)) {
            $data[] = $datafile;
        }

        $data=array_map(function ($item){
            return [
                'email'=>$item[0],
                'nick'=>$item[1],
                'folder_id'=>$item[2]??0,
                'admin_id'=>auth()->user()->id,
            ];
        },$data);
        foreach ($data as $item){
            if (empty($item['email'])||empty($item['nick'])||empty($item['folder_id'])){
                continue;
            }
            if(Nick::get()->where('email',$item['email'])->where('admin_id',$item['admin_id'])->where('folder_id',$item['folder_id'])->first()){
                Nick::get()->where('email',$item['email'])->where('admin_id',$item['admin_id'])->where('folder_id',$item['folder_id'])->first()->update($item);
            }else if(Nick::get()->where('nick',$item['nick'])->where('admin_id',$item['admin_id'])->where('folder_id',$item['folder_id'])->first()){
                //更新
                Nick::get()->where('nick',$item['nick'])->where('admin_id',$item['admin_id'])->where('folder_id',$item['folder_id'])->first()->update($item);
            }else{
                //创建
                Nick::create($item);
            }

        }
        return $this->response()->success('Success message...')->refresh();
    }
    public function form()
    {
        $this->file('file', '文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-nick-post">导入昵称数据</a>
HTML;
    }
}
