<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;  
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class Admin extends Model{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $rules = [
        'mobile'=>'required|is_mobile',
        'name'=>'required|alpha_dash_chinese:2,16',
        'password'=>'required|alpha_dash',
        'role_id'=>'select'
    ];
    protected $message = [
        'mobile.required'=>'手机号不能为空',
        'mobile.is_mobile'=>'手机号格式错误',
        'name.required'=>'用户名不能为空',
        'name.alpha_dash_chinese'=>'用户名格式错误',
        'password.required'=>'密码不能为空',
        'password.alpha_dash'=>'密码格式错误',
        'role_id.select'=>'请选择角色',
    ];
    public function role()
    { 
        return $this->hasOne('App\Model\Role','id','role_id');//描述了在每一个用户都有对应的role
    }  
    public static function get_instance(){
        $instance=new Role;
        return $instance;
    }
    /**
     * 表单数据验证
     * @param 表单数据 $input
     * @return mix|boolean
     */
    public function validator($input){
        if(isset($input['id'])){
            unset($this->rules['password']);
        }
        
        $validator = validator($input,$this->rules,$this->message );
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->toArray();
            foreach($errors as $v){
                return ajaxreturn('error',$v);
            }
        }
        //编辑
        $model=self::on();
        $model->where('mobile',$input['mobile']);
        if(isset($input['id'])){
            $model->where('id','<>',$input['id']);
        }
        $admin=$model->first();        
        if($admin){
            return  ajaxreturn('error','手机号已存在');
        }
        return false;
    }   
    /**
     * 管理员列表
     */
    public function list($param){
        $model=self::on();
        if(isset($param['name']))
            $model->where('name',$param['name']);
        if(isset($param['mobile']))
            $model->where('mobile',$param['mobile']);
        if(isset($param['role_id']))
            $model->where('role_id',$param['role_id']);
        $model->orderBy('id','desc');
        $reuslt=$model->paginate(10);
        return $reuslt;
    } 
    /**
     * 用户登陆
     * @param string $mobile
     * @param string $password
     * @return mix
     */
    public function login($mobile,$password){
        $admin=Admin::where(['mobile'=>$mobile])->first();
        if(!$admin){
            return 2;
        }
        if(encode_passwd($password, $admin->salt) != $admin->password){
            return 3;
        }        
        //登陆验证成功
        try{
            Admin::where('id',$admin->id)->update(['last_time'=>date('Y-m-d H:i:s')]);        
            session()->put(['admin'=>[
                'id'=>$admin->id,
                'role_id'=>$admin->id,
                'name'=>$admin->name,
                'menus'=>serialize(self::menus($admin)),
                'mobile'=>get_fuzzy_mobile($admin->mobile)
            ]]);   
            logger('登录成功'); 
        }catch (\Exception $e){
            return 999;
        }
        return 1;
    }
    /**
     * 获取权限
     */
    public function menus($admin){ 
        if($admin){
            $menus=config('admin_munes');
            //超级管理员，直接获取全部权限
            if($admin->role_id==1){
                return $menus;
            }
            $menus=bulid_tree($menus,'',true);
            //获取权限
            $role=Role::find($admin->role_id);
            $admin_menus=explode(',', $role->menus);
            return self::filter_menus($menus,$admin_menus);
        }
        return false;
    }
    /**
     * 过滤权限
     * @param array $menus 所有菜单
     * @param array $admin_menus 菜单列表
     * @return 权限菜单
     */
    public function filter_menus($menus,$admin_menus){
        $new_menus=[];
        foreach($menus as $key=>$menu){
            if(in_array($menu['value'], $admin_menus)){
                if(isset($menu['children'])){
                    $menu['children']=self::filter_menus($menu['children'],$admin_menus);
                }
                $new_menus[$key]=$menu;
            }
        }
        return $new_menus;
    }
    public static function is_login(){
        $admin=session()->get('admin');
        return $admin;
    }
    /**
     * 建立默认管理员
     */
    public static function default_manage(){
        $role=Role::find(1);
        if(!$role){ 
            $role_id=Role::insertGetId([
                'name'=>'商务总监',                
                'type'=>0,
                'menus'=>'',
                'creat_time'=>date('Y-m-d H:i:s')
            ]);
        }else{
            $role_id=$role['id'];
        }
        $admin=self::find(1);
        if(!$admin){
            $salt=str_random(8);
            self::insertGetId([
                'role_id'=>$role_id,
                'salt'=>$salt,
                'name'=>'管理员',
                'mobile'=>'13333333333',
                'password'=>encode_passwd('123456',$salt),
                'creat_time'=>date('Y-m-d H:i:s')                
            ]);
        }
    }
}