<?php

namespace App\Http\Middleware\Admin;
use Closure;
class AdminAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = explode('/', request()->path()); 
        $controller = ucfirst($path[0]) ?? 'Home';  
        $method = $path[1] ?? ''; 
        $admin=session('admin');  
        $white_list=['Home','Auth',''];  
        //白名单不做校验
        if(in_array($controller,$white_list))
            return $next($request);
        //未登陆跳转登录
        if(!isset($admin)){  
            return redirect('/Home');
        }
        //验证权限  
        $menus=unserialize($admin['menus']); 
        $menu=$method==''?'/'.$controller:'/'.$controller.'/'.$method;
        $menus_list=self::arrToOne($menus);  
        //if(!in_array(menu,$menus_list)){ 子菜单校验        
        //控制器校验
        if(!in_array('/'.$controller,$menus_list)){ 
            abort(404,'没有权限'); 
        }
        //登陆验证
        return $next($request);
    }
    //菜单转换一维数组
    private function arrToOne($multi) {
        $arr = array();
        foreach ($multi as $key => $val) {
            if( is_array($val) ) { 
                if(!empty($val['link']))
                    $arr[] = $val['link'];
                $arr = array_merge($arr, self::arrToOne($val));
            }
        }
        return $arr;
    }
}