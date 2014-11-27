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
        Log::info($status);

        $job->delete();// 删除任务
    }
}