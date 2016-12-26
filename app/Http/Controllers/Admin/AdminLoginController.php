<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Crypt;
use App\Http\Model\User;
use Illuminate\Support\Facades\View;
use Session;


require_once 'resources/org/code/Code.class.php';

class AdminLoginController extends CommonController
{
	public function login(Request $request)
	{	
		if ($input = Input::all()){
			$code = new \Code;
			$_code = $code -> get();
			// check code
			if (strtoupper($input['code']) != $_code){
				// Session::put('msg', 'Wrong Code');
				// $request->session()->put('msg', 'Wrong Code');
				return back()->with('msg', 'Wrong Code');
			}
			// check password
			$user_data = User::first();
			if ($input['user_name'] != $user_data->user_name || $input['user_pass'] != Crypt::decrypt($user_data->user_pass) ){
				// Session::put('msg', 'Wrong username or password !');
				// $request->session()->put('msg', 'Wrong username or password !');
				return back()->with('msg', 'Wrong username or password !');
			}

			Session::put('user', $user_data);
			return redirect('admin/index');

		}else{
    			return view('admin.login');
    		}
   	 }
   	 //generate code
   	public function code()
	{
		$code = new \Code;
		$code -> make();
   	 }
   	  //logout
   	 public function quit()
	{
		Session(['user' => null]);
		return redirect('admin/login');
   	 }



}




?>