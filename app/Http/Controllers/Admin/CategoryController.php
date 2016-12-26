<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;



class CategoryController extends CommonController
{
    //get. admin/category  
    public function index()
    {
    	$category = Category::tree();
    	return view('admin.category.index')->with('data', $category);
    }

    //change the order of the category
    public function changeOrder()
    {
    	$input = Input::all();
    	$cate = Category::find($input['cate_id']);
    	$cate->cate_order = $input['cate_order'];
    	$re = $cate->update();
    	if($re){
    		$data = [
    			'status' => 0,
    			'msg' => 'order is changed successfully',
    		];
    	}else{
    		$data = [
    			'status' => 1,
    			'msg' => 'order change failed',
    		];
    	}
    	return $data;
    }

    



    //post. admin/category
    public function store()
    {

    }

    //get. admin/category/create
    public function create()
    {

    }

    //get. admin/category/{category}
    public function show()
    {

    }

    //delete. admin/category/{category}
    public function destroy()
    {

    }

    //put & patch. admin/category
    public function update()
    {

    }

    //get. admin/category/{category}/edit
    public function edit()
    {

    }

}
