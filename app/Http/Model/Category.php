<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    public static function tree(){
    	$category = Category::orderBy('cate_order')->get();
    	return (new Category) -> getTree($category, 'cate_name', 'cate_id', 'cate_pid', 0);
    }

    public function getTree($data, $field_name, $field_id = 'id', $field_pid = 'pid', $pid = 0){
    	$arr = array();
    	foreach($data as $k => $v){
    		if($v->$field_pid == $pid){
    			$arr[] = $data[$k];
    			foreach($data as $m => $n){
    				if($n->$field_pid == $v->$field_id){
    					$data[$m][$field_name] = '├─' . $data[$m][$field_name];
    					$arr[] = $data[$m];
    				}
    			}
    		}
    	}
    	return $arr;
    }
}

