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

$data=[
    'redirect'=>$_GET['redirect']
    ];
    return view('app-login.login',$data);
}
public function login(Request $request){
   //echo '<pre>';print_r($_POST);echo '</pre>';
        // echo __METHOD__;
        // echo '<pre>';print_r($_POST);echo '</pre>';
        $pass =$request->input('u_pwd');
        $root=$request->input('u_name');
        $is_app=$request->input('is_app');
        print_r($is_app);exit;
        $r=$request->input('redirect');
        //var_dump($r);die;
        $id2 = Cmsmodel::where(['u_name'=>$root])->first();
        //var_dump($id2);
        if($id2){
            if(password_verify($pass,$id2->pwd)){
                $token = substr(md5(time().mt_rand(1,99999)),10,10);
                setcookie('token',$token,time()+86400,'/','52xiuge.com',false,true);
                setcookie('u_name',$id2->u_name,time()+86400,'/','52xiuge.com',false,true);
                setcookie('id',$id2->id,time()+86400,'/','52xiuge.com',false,true);
                $redis_key_web_token='str:u:token:'.$id2->id;
               // var_dump($redis_key_web_token);
                Redis::del($redis_key_web_token);
          Redis::hSet($redis_key_web_token,'web',$token);
              //  print_r($redis);die;
           
               //echo $redis;die;
                //header("Refresh:3;");

     
                 Cmsmodel::where(['id'=>$id2->id])->update(['is_login'=>1]);
                 $res=Redis::expire($redis_key_web_token,30);
                //  if(empty($res)){
                //     Cmsmodel::where(['id'=>$id2->id])->update(['is_login'=>0]);
                //  }
                
                    //var_dump($res);
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