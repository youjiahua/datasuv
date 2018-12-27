<?php 
namespace App\Libraries\vendor; 
 

class CustomLog{ 
    /**
     * 管理员日志  
     */
    static function admin_log($param){  
        if(is_string($param)){ 
            logs('daily')->info($param);
        }else{
            $channel=$param['channel']??'daily';
            $msg=$param['msg']??'';
            $content=$param['content']??[];  
            logs($channel)->info($msg,$content);
        }
    }
}