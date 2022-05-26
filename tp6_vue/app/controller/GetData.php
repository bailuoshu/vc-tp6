<?php
namespace app\controller;
use think\facade\Request;
use app\model\UserList;
use app\BaseController;
use app\model\FriendList as FDB;
use app\model\UserList as UL;
use app\model\MsgList as ML;

class GetData extends BaseController
{
    protected $request;
    public function GetFriendList()
    {
        //好友列表获取
        if(!Request::has('uid','post')){
            return null;
        }
        $uid = Request::param('uid');
        $Fdb = new FDB;
        $Udb = new UL;
        $Mdb = new ML;

        $list = $Fdb->SelectFriend($uid);
        $uid_list = explode(',',$list["friend_uid"]);//返回当前用户的好友id（数组）
        $i = 0;
        $jsonList = [];

        foreach ($uid_list as $key => $arr){
            $u_msg = $Mdb ->SelectFriendList($arr); //返回当前id好友的未读消息
            $u_data = $Udb->SelectFriend($arr);//返回当前id好友的头像，名字等

            $jsonList[$i] = [
                "uname" => $u_data['uname'],
                "uid" => $u_data['uid'],
                "head_url" => $u_data['head_url'],
                "msg" => $u_msg[1]['data'],
                "last_time" => $u_msg[1]['time'],
                "msg_unm" => $u_msg[0]
            ];
            $i++;
                //'{uname:"'.$u_data['uname'].'",uid:"'.$u_data['uid'].'",head_url:"'.$u_data['head_url'].'",msg:"'.$u_msg.'"}';
//            array_push($return_list,$jsonList);
        }
        $index = ["code" => 2,'data'=>$jsonList];
        return json($index);
    }
    public function GetMsgList(){
        if(!Request::has('uid','post')||!Request::has('to_id','post')){
            return null;
        }
        $uid = Request::param('uid');
        $to_id = Request::param('to_id');
        $Mdb = new ML;
        return json($Mdb->SelectMsgList($uid,$to_id));
    }
    public function SetMsg(){
        $data = Request::param();
        var_dump($data);
    }
    public function updateUser(){//修改信息，待补充
        if(!Request::has('uid','post')){
            return null;
        }
        $uid = Request::param('uid');
        $data = Request::param();
        $Udb = new UL;
        return  $Udb->updataUser($data);
    }
    public function addFriend(){//需要添加：好友请求同意后再添加
        if(Request::has('f_uid','post')&&Request::has('uid','post')){
            $uid = Request::param('uid');
            $f_uid = Request::param('f_uid');
            if($uid == $f_uid){
                return json([
                    'code' => 4
                ]);
            }
            $Fdb = new FDB;
            $index = $Fdb->addFrinend($uid,$f_uid);
            return json($index);
        }
    }
    public function AlreadyLook(){////有错
        if(!Request::has('from_uid','post')){
            return null;
        }
        $uid = Request::param('from_uid');
        $from_uid = $uid;//来自谁的信息已经被查看了
        $Mdb = new ML;

        header("content-type:text/html;charset=utf-8");
        date_default_timezone_set("PRC");//设置时区
        $dateNow = date("Y-m-d H:i:s");
        return $Mdb->updateWhitTime($dateNow,$from_uid);
    }
}
