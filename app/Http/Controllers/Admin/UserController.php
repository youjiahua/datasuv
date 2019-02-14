<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;  
use App\Model\Admin;
use App\Model\Role;
use Illuminate\Http\Request;   
use App\Libraries\vendor\CustomLog;

class UserController extends AdminController{
    public function __construct(){  
        parent::__construct();
        view()->share('head_active','system');
        view()->share('active','user'); 
    } 
    
    public function __invoke(){
        return $this->index();
    }
    public function index(){ 
        $param=self::Search();  
        $list=(new Admin)->list($param); 
        $list->appends($param); 
        $role=(new Role)->list();
        return view('admin.user')->with(['list'=>$list,'role'=>$role,'search'=>$param]); 
    }
    
    public function user_form(){
        if(Request()->isMethod('get')){ 
            $role=(new Role)->list();
            return view('admin.user-form')->with([
                'role'=>$role,
                'admin'=>Admin::get_instance()
            ]);
        }
        $input=Request()->only(['mobile','name','password','role_id']);    
        //数据验证
        if(($result=(new Admin)->validator($input))==true){
            return $result;
        }
        try{
            $salt=str_random(8);
            $id=Admin::insertGetId([
                'role_id'=>$input['role_id'],
                'salt'=>$salt,
                'name'=>$input['name'],
                'mobile'=>$input['mobile'],
                'password'=>encode_passwd($input['password'],$salt),
                'creat_time'=>date('Y-m-d H:i:s')
            ]);
            if($id){
                return ajaxreturn('success','创建成功');
            }else{
                return ajaxreturn('error','创建失败'); 
            }
        }catch (\Exception $e){
            CustomLog::admin_log('用户创建失败:'.$e->getMessage());
            return ajaxreturn('error',$e->getMessage());
        }
    }
    
    public function edit_form($id){        
        $admin=Admin::find($id);
        if(Request()->isMethod('get')){
            if(empty($id))
                return redirect('/User/user_form');
            $role=(new Role)->list();
            return view('admin.user-form')->with([
                'role'=>$role,
                'admin'=>$admin
            ]);
        }
        $input=Request()->only(['mobile','name','password','role_id']);  
        $input['id']=$id;
        //数据验证
        if(($result=(new Admin)->validator($input))==true){
            return $result;
        }
        try{            
            
            $salt=$admin->salt;
            $param=[
                'role_id'=>$input['role_id'], 
                'mobile'=>$input['mobile'],
                'name'=>$input['name']
                ];
            if(isset($input['password'])){
                $param['password']=encode_passwd($input['password'],$salt);
            }
            Admin::where('id',$id)->update($param);
            return ajaxreturn('success','编辑成功');
        }catch(\Exception $e){
            CustomLog::admin_log('用户编辑失败:'.$e->getMessage());
            return ajaxreturn('error',$e->getMessage());
        }
        $input=Request()->only(['name','some']);  
    }
}