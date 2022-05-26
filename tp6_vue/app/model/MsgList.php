<?php
namespace app\model;

use think\facade\Db;
use think\Model;

class MsgList extends Model
{
    protected $pk = 'uid';
    public function SelectMsgList($uid,$from_id){
        // 取出主键为uid的用户数据
        $list = Db::table('msg_list')->where('to_uid|from_uid',$uid)->where('to_uid|from_uid',$from_id)->select();
        return $list;
    }
    public function SelectFriendList($uid){
        //几条未读
        $cont = Db::table('msg_list')->where('from_uid',$uid)->where('is_see',0)->count();
        //最新一条数据
        $msg = Db::table('msg_list')->where('to_uid|from_uid',$uid)->order('time', 'desc')->find();
        $list[0]=$cont;
        $list[1]=$msg;

        return $list;
    }
    public function SetMsg($data){
        $setMsg = Db::table('msg_list')->insert($data);
        return $setMsg;
    }
    public function updateWhitTime($dateNow,$uid){
        $updateLook = Db::table('msg_list')
            ->where('from_uid',$uid)
            ->where('time','<',$dateNow)
            ->update(['is_see' => 1]);
    }
}