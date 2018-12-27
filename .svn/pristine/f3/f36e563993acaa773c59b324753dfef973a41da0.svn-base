<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;      
    protected $rules = [
        'name'=>'required|alpha_dash_chinese:2,16',
        'some'=>'required',
    ];
    protected $message = [
        'name.required'=>'角色名不能为空',
        'name.alpha_dash_chinese'=>'角色名格式错误',
        'some.required'=>'请选择权限',
    ];
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
        $validator = validator($input,$this->rules,$this->message );
        if ($validator->fails()) {
            $errors=$validator->getMessageBag()->toArray();
            foreach($errors as $v){
                return ajaxreturn('error',$v);
            }
        }
        return false;
    }
    /**
     * 角色列表
     */
    public function list(){
        $model=self::on();
        $reuslt=$model->get();
        return $reuslt;
    }    
}