<?php
namespace app\controller;
use think\facade\Request;
use app\BaseController;
use app\model\UserList;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    protected function setToken($uid) {
        $key = "vuechatbyluoshu";
        $token=array(
            "iss"=>$key,        //签发者 可以为空
            "aud"=>'',          //面象的用户，可以为空
            "iat"=>time(),      //签发时间
            "nbf"=>time(),    //在什么时候jwt开始生效  （这里表示签发后立即生效）
            "exp"=> time()+1*60*60*36, //token 过期时间1秒*60*60*48=两天
            "data"=>[           //加入uid，后期同样使用uid进行比对
                'uid'=>$uid,
            ]
        );

            $jwt = JWT::encode($token, $key, "HS256");  //根据参数生成了 token
        return $jwt;
    }
    public function login(){
        if(request()->isPost()){
            if(Request::has('uid','post') && Request::has('password','post')){
                $USER = new UserList();
                $uid = Request::param('uid');
                $password = Request::param('password');
                $index = $USER -> SelectUserData($uid);
                if ($index == '0'){
                    return json([
                        'code' => 0,
                        'msg' => '账户未注册'
                    ]);
                }
                else if($index['password'] != $password){
                    return json([
                        'code' => 1,
                        'msg' => '密码错误'
                    ]);
                }
                else if($index['password'] == $password && $index['uid'] == $uid){
                    $toToken = $this->setToken($index['uid']);
                    //设置token令牌
                    return json([
                        'code' => 2,
                        'msg' => '登录成功',
                        'uid' => $uid,
                        'uname' => $index['uname'],
                        'selfHeaderUrl' => $index['head_url'],
                        'token' => $toToken
                    ]);
                }else {return json('错误，请稍后重试',500);}
            }else {return json('请求信息不全',403);}
        }else return json(404,404);
    }
    public function register(){
        if(request()->isPost()){
            if(Request::has('password','post') && Request::has('uname','post')) {
                $uname = Request::param('uname');
                $password = Request::param('password');
                $Udb = new UserList();
                $index = $Udb -> register($uname,$password);
                return json([
                    'code'=>2,
                    'uid'=>$index,
                ]);
            }else return json(404,404);
        }else return json(404,404);
    }
}
