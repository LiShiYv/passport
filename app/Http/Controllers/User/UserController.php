<?php
/**
 * Created by PhpStorm.
 * User: 李师雨
 * Date: 2019/3/21
 * Time: 11:27
 */
namespace  App\Http\Controllers\User;
use App\Model\Cmsmodel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
public function userl(){
    $redirect=$_GET['redirect'] ?? env('SHOP_URL');
    $data=[
        'redirect'=>$redirect
    ];
    return view('user.login',$data);
}
public function login(Request $request){
   //echo '<pre>';print_r($_POST);echo '</pre>';
        // echo __METHOD__;
        // echo '<pre>';print_r($_POST);echo '</pre>';
        $pass =$request->input('u_pwd');
        $root=$request->input('u_name');
        $r=$request->input('redirect')?? env('SHOP_URL');
        //var_dump($r);die;
        $res = Cmsmodel::where(['u_name'=>$root])->first();
        //var_dump($id2);
        if($res){
            if(password_verify($pass,$res->pwd)){
                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                setcookie('token',$token,time()+86400,'/','sub.52xiuge.com',false,true);
                setcookie('u_name',$res->u_name,time()+86400,'/','sub.52xiuge.com',false,true);
                setcookie('id',$res->id,time()+86400,'/','sub.52xiuge.com',false,true);
                $redis_key_web_token='str:u:token:'.$res->uid;
                Redis::del($redis_key_web_token);
                Redis::hSet($redis_key_web_token,'web',$token);

                // echo $redis_key_web;die;       $redis_key_web='str:u:web:'.$id2->id;
                //                Redis::set($redis_key_web,$token);
                //                Redis::expire($redis_key_web,86400);
                header("Refresh:3;$r");
                echo '登录成功';
            } else {
                die('密码或用户名错误');

            }
        }else{
            die('用户不存在');
        }

    }


}