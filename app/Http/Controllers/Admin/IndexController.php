<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;
use Illuminate\Support\MessageBag;





class IndexController extends CommonController
{
    //
    public function index()
	{
		return view('admin.index');
   	 }
   public function info()
	{
		return view('admin.info');
   	 }
   //change password
   public function pass(Request $request)
	{	if($input = Input::all()){
			$rules = [
				'password' => 'required|between:6, 20|confirmed' ,
			];
			$message = [
				'password.required' => 'New password is required',
				'password.between' => 'New password should be between 6 and 20',
				'password.confirmed' => 'New password is different from confirmation',
			];
			$validator = Validator::make($input, $rules, $message);
			if ($validator->passes()){
				$user = User::first();
				$_password = Crypt::decrypt($user->user_pass);
				if ($input['password_o'] == $_password){
					$user->user_pass = Crypt::encrypt($input['password']);
					$user->save();
					return back()->withErrors(['errors'=>'Password is changed successfully !']);
				}else{
                			return back()->withErrors(['errors'=>'Wrong original password !']);
				}

			}else{
				// Session::flash('msg', $validator);
                		return back()->withErrors($validator);
				

   	 		}
		}else{
				return view('admin.pass');
	   	 	}

	   	 	
	}




	   	 	
}
 


	



