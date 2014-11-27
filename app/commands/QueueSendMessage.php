<?php
/*
**Author:tianling
**createTime:14-11-26 下午11:55
*/

class QueueSendMessage{
    public function fire($job, $data)
    {
        //echo $data['message'];
        Log::info($data['message']); // 生成日志
        $job->delete();               // 删除任务
    }
}