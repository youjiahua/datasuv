<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController; 
use App\Model\Sms;

class SmsController extends AdminController{ 
    public function __construct(){
        parent::__construct();
        view()->share('head_active','system');
        view()->share('active','sms');
    }
    public function __invoke(){
        return $this->index();
    }
    public function index(){
        $param=parent::Search(); 
        $list=(new Sms)->list($param); 
        $list->appends($param);
        return view('admin.sms')->with(['list'=>$list,'search'=>$param]); 
    }
}