<?php
namespace app\model;

use think\facade\Db;
use think\Model;

class FriendList extends Model
{
    protected $pk = 'uid';
    public function SelectFriend($uid){
        // 取出主键为uid的数据
        $data = FriendList::where('uid',$uid)->find();
        return $data;
    }
    public function addFrinend($uid,$f_uid){
        $frindList_1 = FriendList::where('uid',$uid)->find();
        $frindList_2 = FriendList::where('uid',$f_uid)->find();
        $isset_uid = strstr($frindList_1["friend_uid"],$f_uid);
        if($frindList_2==NULL){
            return [
                'code' => 3,//没有这个人
            ];
        }
        if($isset_uid){//好友列表是否有对方好友
            return [
                'code' => 1,
            ];
        }
        if($frindList_1["friend_uid"]){
            Db::name('friend_list')
                ->where('uid', $uid)
                ->update(['friend_uid' => $f_uid.",".$frindList_1["friend_uid"]]);

        }else{
            Db::name('friend_list')
                ->where('uid', $uid)
                ->update(['friend_uid' => $f_uid]);
        }
        if($frindList_2["friend_uid"]){
            Db::name('friend_list')
                ->where('uid', $f_uid)
                ->update(['friend_uid' => $uid.",".$frindList_2["friend_uid"]]);

        }else{
            Db::name('friend_list')
                ->where('uid', $f_uid)
                ->update(['friend_uid' => $uid]);
        }
        return [
            'code' => 2,
        ];
    }
}