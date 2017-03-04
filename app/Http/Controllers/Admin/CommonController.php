<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class CommonController extends Controller
{
    //Login
    
    //upload
    public function upload()
    {
        $input = Input::file();
        dd($input);
    }
    
}


?>