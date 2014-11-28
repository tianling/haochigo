<?php
/*
**Author:tianling
**createTime:14-11-26 下午11:55
*/

class QueueSendMessage{

    public function send($job, $data)
    {
        $send = App::make('SendMessageClass');

        $send->mobile = $data['mobile'];
        $send->tpl_id = $data['tpl_id'];
        $send->tpl_value = $data['tpl_value'];

        $status = $send->tpl_send();
        $log = array(
            'status'=>$status,
            'time'=>date('Y-m-d H:i:s',time())
        );
        $log = json_encode($log);

        Log::info($log);

        $job->delete();// 删除任务
    }
}