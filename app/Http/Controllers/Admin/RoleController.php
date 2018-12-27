<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController; 
use App\Model\Role;
use Illuminate\Http\Request; 
use App\Libraries\vendor\CustomLog;

class RoleController extends AdminController{ 
    protected $valid=[
        'name'=>'required',
        'some'=>'required'
    ];
    public function __construct(){
        parent::__construct();
        view()->share('head_active','system');
        view()->share('active','role');
    }
    public function __invoke(){
        return $this->index();
    }
    public function index(){        
        $list=(new Role)->list(); 
        return view('admin.role')->with(['list'=>$list]);
    } 
    public function role_form(){ 
        if(Request()->isMethod('get')){
            $input=Request()->only(['name','some']); 
            $menus=config('admin_munes'); 
            $role_tree= json_encode(bulid_tree($menus));  
            return view('admin.role-form')->with([
                'role_tree'=>$role_tree,
                'role'=>Role::get_instance()      
            ]);
        }
        $input=Request()->only(['name','some']);
        if(($result=(new Role)->validator($input))==true){
            return $result;
        }
        try{
            $id=Role::insertGetId([
                'name'=>$input['name'],
                'menus'=>$input['some'],
                'creat_time'=>date('Y-m-d H:i:s')
            ]);
            if($id){
                return ajaxreturn('success','创建成功');
            }else{
                return ajaxreturn('error','创建失败');
            }
        }catch (\Exception $e){
            CustomLog::admin_log('角色创建失败:'.$e->getMessage());
            return ajaxreturn('error',$e->getMessage());
        }
    }
    public function edit_form($id){
        if(Request()->isMethod('get')){ 
            if(empty($id))
                return redirect('/Role/role_form');
            $menus=config('admin_munes');
            $role_tree= json_encode(bulid_tree($menus));
            $role=Role::find($id);
            return view('admin.role-form')->with(['role_tree'=>$role_tree,'role'=>$role]);
        }
        $input=Request()->only(['name','some']); 
        if(($result=(new Role)->validator($input))==true){
            return $result;
        }
        try{
            Role::where('id',$id)->update([
                'name'=>$input['name'],
                'menus'=>$input['some'],
            ]); 
            return ajaxreturn('success','编辑成功'); 
        }catch(\Exception $e){
            CustomLog::admin_log('角色编辑失败:'.$e->getMessage());
            return ajaxreturn('error',$e->getMessage());
        }
        $input=Request()->only(['name','some']);  
    }
}