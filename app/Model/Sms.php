<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model{
    protected $table = 'sms';
    protected $primaryKey = 'id';
    public $timestamps = false;      
    /**
     * 短信列表
     */
    public function list($param){
        $model=self::on(); 
        if(isset($param['mobile']))
            $model->where('mobile',$param['mobile']); 
        $model->orderBy('id','desc');
        $reuslt=$model->paginate(10);
        return $reuslt;
    } 
    /**
     * 发送短信
     * @param string $mobile 手机号
     * @param int $type 短信类型
     * @return boolean
     */
    public function send($mobile, $type,$code) {
        $config=config('sms'); 
         
        $content = '';
        switch ($type) {
            case 1:
                $content = '您的登录短信验证码为' . $code . ',有效期为5分钟，请及时使用！【datasuv】';
                break;
            default:
                return false;
                break;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $config['SMSTSendUrl']);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-' .$config['SMSApiKey']);
        curl_setopt($ch, CURLOPT_POST, TRUE);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $mobile, 'message' => $content));
        
        $result = curl_exec($ch);
        curl_close($ch);
        if (empty($result)) {
            return false;
        }
        
        $ret = json_decode($result, true); 
        $error = $ret['error'];
        $msg = $ret['msg'];
        
        $data = [];
        $data['mobile'] = $mobile;
        $data['type'] = $type;
        $data['content'] = $content;
        $data['code'] = $code;
        if ($error < 0 || $error > 0) {
            $data['status'] = 0;
            $batch_id = 0;
        } else {
            $data['status'] = 1;
            $batch_id = $ret['batch_id'];
        }
        //$data['msg'] = $msg;
        $data['batch_id'] = $batch_id;
        $data['send_time'] = date('Y-m-d H:i:s');
        $data['agent'] = $_SERVER['HTTP_USER_AGENT'];
        //$id = $this->SMS->create($data); 
        $id=0;
        $id=self::insertGetId($data);
        if ($id&&$data['status']==1) {
            return true;
        }
        return true;
    }
}