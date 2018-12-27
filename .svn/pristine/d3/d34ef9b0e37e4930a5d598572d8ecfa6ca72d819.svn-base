<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Model\{Admin,Sms}; 

class AuthController extends AdminController{
    private $verifyCode='verifyCode';
    private $verifyTime='verifyTime';
    private $smsCode='smsCode';
    /**
     * 登陆
     */
    public function login(){ 
        if(request()->isMethod('post')){
            $input = request()->only(['mobile', 'code','password','sms_code']); 
            $smsCode=session()->get($this->smsCode);
            $verifyCode=session()->get($this->verifyCode);
            if(md5($input['code'])!=$verifyCode){                
                return ajaxreturn('error','验证码错误');
            }
            if(empty($input['sms_code'])||md5($input['sms_code'])!=$smsCode){    
                return ajaxreturn('error','短信验证码错误');
            }
            $result=(new Admin)->login($input['mobile'],$input['password']);
            switch ($result){
                case 1:
                    session()->remove($this->verifyTime);
                    session()->remove($this->smsCode);
                    return ajaxreturn('success','登陆成功',['href'=>'User']);     
                    break;
                case 2:
                    return ajaxreturn('error','手机号不存在');
                case 3:
                    return ajaxreturn('error','密码错误');
                    break;
                default:
                    return ajaxreturn('error','系统错误');
                    break;
            }  
        }
    }
    /**
     * 退出登陆
     * @return \App\Model\mix
     */
    public function logout(){ 
        session()->forget('admin');
        return redirect('/');
    }
    /**
     * 短信发送
     */
    public function sms(){ 
        if(Request()->ajax()){    
            $expires=5*60;//5分钟短信验证码过期
            $input = request()->only(['mobile', 'code']);
            $mobile=$input['mobile'];
            $code=$input['code'];
            $return=[
                'status'=>'',
                'msg'=>''
            ];
            if(empty($mobile)){           
                $return['status']='error';
                $return['msg']='请输入手机号码';
            }else if(is_mobile($mobile)){
                $admin=Admin::where('mobile',$mobile)->first();
                if($admin){ 
                    $verifyCode=session()->get($this->verifyCode);
                    if(md5($code)==$verifyCode){                         
                        $verifyTime=session()->get($this->verifyTime)??0;
                        //验证码过期判断
                        if($verifyTime<time()-$expires||$verifyTime==0){
                            $code=sms_code(); 
                            //发送验证码
                            if((new Sms())->send($mobile, 1,$code)){                                   
                                session()->put($this->verifyTime,time());
                                session()->put($this->smsCode,md5($code));
                                $return['status']='success';
                                $return['msg']='ok';
                            }else{
                                $return['status']='error';
                                $return['msg']='短信发送失败';
                            } 
                        }else{                        
                            $return['status']='error';
                            $return['msg']='验证码已发送';
                        }
                    }else{                    
                        $return['status']='error';
                        $return['msg']='验证码错误';
                    }
                }else{                    
                    $return['status']='error';
                    $return['msg']='手机号不存在';
                }
            }else{
                $return['status']='error';
                $return['msg']='手机号码错误';
            }             
            return ajaxreturn($return['status'],$return['msg']);
        }
    }
    /**
     * 验证码
     * @return image
     */
    public function verify(){ 
        $code=verifyCode();  
        session()->put($this->verifyCode, md5($code)); 
    }
}