<?php
namespace app\http;

use think\worker\Server;

use app\model\MsgList as ML;

// +----------------------------------------------------------------------
// | D:\phpstudy_pro\Extensions\php\php7.3.4nts\php.exe think worker:server 在tp目录下指令启动
// +----------------------------------------------------------------------


class Worker extends Server
{
    protected $socket = 'websocket://0.0.0.0:2345';//创建套接字
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        //$data是json类型，前端返回必须是转化一下
        $MsgData = json_decode($data);
//        检查数据是否齐全
        if(isset($MsgData->type,$MsgData->token,$MsgData->from_uid,$MsgData->from_uname,$MsgData->time)){
            switch ($MsgData->type){

                //=========绑定信息=========//
                case 'bind': {
                    //绑定时获取并验证uid及token
                    $connection->uid = $MsgData->from_uid;
                    $this->worker->uidConnections[$connection->uid] = $connection;
                    break;
                }

                //=========发送信息=========//
                case 'text':{
                    if(isset($MsgData->to_uid,$MsgData->from_uid,$MsgData->data)){
                        //接受信息同时更新SQL数据
                        $msq = [
                            'from_uid' => $MsgData->from_uid,
                            'from_uname' => '  ',
                            'is_see' => 0,
                            'to_uid' => $MsgData->to_uid,
                            'to_uname' => "  ",
                            'type' => $MsgData->type,
                            'data' => $MsgData->data
                        ];
                        $setMsg = new ML();
                        $setMsg -> SetMsg($msq);
                        //$conn1 = $this->worker->uidConnections[$MsgData->from_uid];
                        //判断是否在线，不在线直接存sql
                        if(isset($this->worker->uidConnections[$MsgData->to_uid])){
                            $conn = $this->worker->uidConnections[$MsgData->to_uid];
                            $conn->send($data);
                        }

                        break;
                    }
                    break;
                }
                //=========type错误=========//
                default: $connection -> close;
                break;
            }
        }
    }
    /**
     * 当连接建立时触发的
     * @param $connection
     */
    public function onConnect($connection)
    {
        $conn = $this->worker;
    }
    /**
     * 当连接断开时触发的
     * @param $connection
     */
    public function onClose($connection)
    {
    }
    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }
    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}