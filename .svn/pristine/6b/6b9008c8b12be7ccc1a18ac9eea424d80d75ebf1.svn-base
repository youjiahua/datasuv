<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class AdminController extends Controller{
    function __construct(){    
        $admin = session('admin'); 
        if($admin){
            view()->share('admin',$admin);
            view()->share('menus',unserialize($admin['menus']));
        }
    }
    /**
     * 表单查询条件组装 
     */
    public function Search(){ 
        $search=Request()->all();    
        $param=[];
        if(isset($search['search'])){
            $arr=$search['search'];
            foreach($arr as $k=>$v){
                if($k=='name'){
                    if(is_mobile($v)){
                        $param['mobile']=$v;
                        continue;
                    }
                }
                $param[$k]=$v;
            }
            //过滤search
            unset($search['search']);
        }
        //过滤_token
        unset($search['_token']);
        //过滤page
        unset($search['page']);
        return array_merge($param,$search);
    }
}