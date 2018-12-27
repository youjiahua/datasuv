<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Model\Admin;

class  HomeController extends AdminController
{
    public function __invoke(){  
        //Admin::default_manage();
        if(Admin::is_login())
            return redirect('/User');
        else
            return view('admin.login');
    }
}