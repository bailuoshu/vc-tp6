<?php
namespace app\model;

use think\facade\Db;
use think\Model;

class UserList extends Model
{
    protected $pk = 'uid';
    public function SelectFriend($uid){
        // 取出主键为uid的数据
        $data = UserList::where('uid',$uid)->find();
        return $data;
    }
    public function SelectUserData($uid){
        // 取出主键为uid的数据
        $data = UserList::where('uid',$uid)->findOrEmpty();
        if($data == []){
            $data = '0';
        }
        return $data;
    }
    public function updataUser($data){//个人信息更改
        if(isset($data["uname"])){

        }
        if(isset($data["head_url"])){

        }
        if(isset($data["password"])){

        }
    }
    public function register($uname,$psw){
        $data = ['uname' => $uname, 'password' => $psw];
        $uid = Db::name('user_list')->strict(false)->insertGetId($data);
        $data = ['uid' => $uid, 'friend_uid' => ''];
        Db::name('friend_list')->insert($data);
        return $uid;
    }
}