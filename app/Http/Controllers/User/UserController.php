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

class UserController extends Controller
{
public function userl(){
    return view('user.login');
}
public function login(Request $request){
   echo '<pre>';print_r($_POST);echo '</pre>';



}
}