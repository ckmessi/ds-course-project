<?php

namespace App\Http\Controllers;

use App\User;
use App\GradeProject1;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function login(Request $request){
    	$dsproject_key = $request->input('dsproject_key');

		// check login state    	
    	if(session()->has('user_id')){
             // $request->session()->flush();
             // $request->session()->regenerate();
    		 return redirect('/home');
    	}

    	// veryify authenrization
    	$user_base = User::where(['dsproject_key' => $dsproject_key])->first();
    	if($user_base == null){
    		$request->session()->flash('message_failed', '身份验证失败！');
    		return redirect('/');
    	}

    	// record session and redirect to home
    	$request->session()->put('user_id', $user_base['user_id']);
    	$request->session()->flash('message_success', '登录成功！');
		return redirect('/home');	    
    }

    public function logout(Request $request){
         $request->session()->flush();
         $request->session()->regenerate();
         return redirect('/');
    }

    public function home(Request $request){

        // 检查token和user_id是否匹配
        if ($request->session()->has('user_id') == false){
            return redirect('/');
        }
        $user_id = $request->session()->get('user_id');
        // 用户
        $user_base = User::where(['user_id' => $user_id])->first();

        // 查找成绩
        $grade_project1_base = GradeProject1::where(['user_id' => $user_id])->first();

        return view('home', ['grade_project1' => $grade_project1_base, 'user_name' => $user_base['user_name']]);
    }

    public function confirm(Request $request){
        
        if ($request->session()->has('user_id') == false){
            return redirect('/');
        }

        $user_id = $request->session()->get('user_id');
        $res = GradeProject1::where(['user_id' => $user_id])->update(['grade_confirm' => 1]);
        if($res == false){
            $request->session()->flash('message_failed', '确认失败!');
        }
        else{
            $request->session()->flash('message_success', '确认成功!');
        }

        return redirect('/home');

    }

    public function showList(Request $request){
         if ($request->session()->has('user_id') == false){
            return redirect('/');
        }
        $project1_list = GradeProject1::join('user', 'user.user_id', '=', 'grade_project1.user_id')->get();
        return view('list', ['project1_list' => $project1_list]);
    }


}
