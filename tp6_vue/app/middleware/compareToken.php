<?php

namespace app\middleware;
use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class compareToken{
    public function handle ($request, \Closure $next){
        // 获取请求头header中的authorization（token值）

        $token = request() -> header('VCTOKEN');
        // 去除token值中的bearer+空格标识
        $token = str_replace('bearer ', '', $token);
        // return response($token);

        if($token == "undefined" || $token == null){
            // abort终止操作，返回结果
            abort(json(['message' => '登陆状态失效，请重新登录', 'code' => 4], $httpCode = 401));
            // return response($code);
        }
        // key必须与生成token值得字符串相同
        $key='vuechatbyluoshu';
        try {
            JWT::$leeway = 60;//当前时间减去60，把时间留点余地用于后面的操作
            $decoded = JWT::decode($token, new Key($key, "HS256"));//HS256方式，这里要和签发的时候对应
            //return json($decoded);验证返回的解码对不对
            // 解析过程中如果出现不对的情况就利用下方catch方法，利用jwt解析问题返回错误信息
        } catch(\Firebase\JWT\SignatureInvalidException $e) { // token不正确
            abort(json(['message' => '登陆状态失效，请重新登录', 'code' => 4], $httpCode = 401));
        } catch(\Firebase\JWT\BeforeValidException $e) { // token过了之前设置的期限
            abort(json(['message' => '登陆状态失效，请重新登录', 'code' => 4], $httpCode = 401));
        } catch(\Firebase\JWT\ExpiredException $e) { // token过期
            abort(json(['message' => '登陆状态失效，请重新登录', 'code' => 4], $httpCode = 401));
        } catch(Exception $e) { //其他错误
            abort(json(['message' => '登陆状态失效，请重新登录', 'code' => 4], $httpCode = 401));
        }
        // 如果没问题，就执行下一步接口函数操作
        return $next($request);
    }
}