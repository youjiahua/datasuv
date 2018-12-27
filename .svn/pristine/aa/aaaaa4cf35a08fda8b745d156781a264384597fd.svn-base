<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        /**
         * 数字、字母、下划线、中文 
         */
        Validator::extend('alpha_dash_chinese', function ($attribute, $value, $parameters, $validator){
            return preg_match('/^[0-9a-zA-Z_\x{4e00}-\x{9fa5}]{'.$parameters[0].','.$parameters[1].'}$/u', $value) > 0;
        });
        Validator::replacer('alpha_dash_chinese', function ($message, $attribute, $rule, $parameters) {
            $message = str_replace(':min', $parameters[0], $message);
            $message = str_replace(':max', $parameters[1], $message);
            return $message;
        });
        /**
         * 验证手机号的格式 
         */
        Validator::extend('is_mobile', function ($attribute, $value, $parameters, $validator) {
            return is_mobile($value);
        });
            
        /**
         * 下拉框验证 
         */
        Validator::extendImplicit('select', function ($attribute, $value, $parameters, $validator) {
            return $value !== null && $value !== '' && $value >= 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
