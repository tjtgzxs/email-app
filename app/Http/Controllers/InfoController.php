<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Nick;
use Illuminate\Http\Request;
use App\Models\Folder;
class InfoController extends Controller
{
    public function getInfo(Request $request)
    {

        $data=[];
        $emails=Email::get()->where('deleted_at',"not",null)->toArray();

        foreach ($emails as $email){
            $email_data=[];
            $email_data['id']=$email['id'];
            $email_data["email"]=$email['email_host'];
            $email_data["username"]=$email['email_username'];
            $email_data['password']=$email['email_password'];
            $email_data['tele_token']=$email['tele_token'];
            $email_data['tele_chat_id']=$email['tele_chat_id'];
            $folders=Folder::get()->where('email_id',$email['id'])->where('deleted_at',"not",null)->toArray();
            if (empty($folders)) continue;
            $email_data['folder']=[];
            foreach ($folders as $folder){
                $folder_data=[];
                $folder_data['id']=$folder['id'];
                $folder_data['folder']=$folder['folder'];
                $folder_data['from']=$folder['from'];
                $folder_data['analyze']=$folder['analyze'];
//                $folder_data['continue']=$folder['continue'];
                if(!empty($folder['continue'])){
                    $folder_data['continue']=explode(",",$folder['continue']);
                    foreach ($folder_data['continue'] as $key=>$value){
                        $folder_data['continue'][$key]=trim($value,"\"");
                    }
                }else{
                    $folder_data['continue']=[];
                }
                $folder_data['name']=$folder['to'];
                array_push($email_data['folder'],$folder_data);
            }
            array_push($data,$email_data);
        }
        return response()->json($data);
    }

    public function getMachine(Request $request){
        $request['email']=$request->input('email');
        $request['folder_id']=$request->input('folder_id');
        if (empty($request['email'])||empty($request['folder_id'])){
            return response()->json(['code'=>201,'msg'=>'email or folder_id is empty']);
        }
        $email=Nick::get()->where('email',$request['email'])->where('folder_id',$request['folder_id'])->first();
        if(empty($email)){
            return response()->json(['code'=>2011,'msg'=>'email or folder_id is error','data'=>$email]);
        }else{
            return response()->json(['code'=>200,'msg'=>'success','data'=>$email]);
        }
    }
}
