<?php

namespace App\Providers;

use Validator;
use Form;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        //小写字母
        Validator::extend('lowercase',function ($attribute,$value,$parameters){
            return preg_match('/^[a-z]/',$value);
        });
        //正整数
        Validator::extend('positive',function ($attribute,$value,$parameters){
            return preg_match('/^\+?[1-9]\d*$/',$value);
        });
        /**
         * 自定义多个复选框
         * @author xingyonghe
         * @$name string  name值
         * @$list array   复选框键值对
         * @$cheked string 默认选中的值,如果存在多个，用逗号隔开的方式保存
         * @$options array 其他参数，style、id等属性定义
         * @return string
         */
        Form::macro('checkboxs', function($name, $list=[], $cheked, $options = []){
            $html = '';
            $cheked = explode(',',$cheked);
            foreach ($list as $value => $display) {
                if(in_array($value,$cheked)){
                    $html .= Form::checkbox($name,$value,true,$options).$display;
                }else{
                    $html .= Form::checkbox($name,$value,null,$options).$display;
                }

            }
            return $html;
        });

        /**
         * 自定义多个单选框
         * @author xingyonghe
         * @$name string  name值
         * @$list array   复选框键值对
         * @$cheked string 默认选中的值
         * @$options array 其他参数，style、id等属性定义
         * @return string
         */
        Form::macro('radios', function($name, $list=[], $cheked, $options = []){
            $html = '';
            foreach ($list as $value => $display) {
                if($cheked == $value){
                    $html .= Form::radio($name,$value,true,$options).$display;
                }else{
                    $html .= Form::radio($name,$value,null,$options).$display;
                }

            }
            return $html;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
