<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;



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

    



    //post. admin/category 提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'cate_name' => 'required' ,

        ];
        $message = [
            'cate_name.required' => 'Cate name is required',
        ];
        $validator = Validator::make($input, $rules, $message);
        if ($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','errors! try later');
            }

        }else{
            // Session::flash('msg', $validator);
            return back()->withErrors($validator);


            }

    }

    //get. admin/category/create
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add', compact('data'));
    }

    //get. admin/category/{category}
    public function show()
    {

    }

    //delete. admin/category/{category}
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id', $cate_id)->delete();
        Category::where('cate_pid', $cate_id)->update(['cate_pid'=>0]);
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败，请重试'
            ];
        };
        return $data;
    }

    //put & patch. admin/category/{category}
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','errors! try later');
        }

    }

    //get. admin/category/{category}/edit
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();

        return view('admin/category/edit', compact('field', 'data'));
    }

}
