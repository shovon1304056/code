<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subCategory()
    {
    	$category = DB::table('categories')->get();
    	$sub_category= DB::table('subcategories')
    					->join('categories','subcategories.category_id','categories.id')
    					->select('subcategories.*','categories.category_name')
    					->get();
    	return view('admin.category.sub_category',compact('category','sub_category'));
    }

    public function store_subCategory(Request $request)
    {
    	$request->validate([
    		'category_id'=>'required',
    		'subcategory_name'=>'required'
    	]);

    	$data= array();
    	$data['category_id']=$request->category_id;
    	$data['subcategory_name']=$request->subcategory_name;

    	$sub_category=DB::table('subcategories')->insert($data);
    	$notification= array(
            'message'=>'Subcategory Inserted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);


    }

    public function delete_subCategory($id)
    {
    	$sub_category = Subcategory::findorFail($id);
    	//$sub_category = DB::table('subcategories')->where('id',$id)->first();
    	$sub_category->delete();
    	$notification= array(
            'message'=>'Subcategory Deleted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function edit_subCategory($id)
    {
    	$category = DB::table('categories')->get();
    	$subcategory = DB::table('subcategories')->where('id',$id)->first();
    	return view('admin.category.update_subCategory',compact('category','subcategory'));
    }
    
    public function update_subCategory(Request $request)
    {
    	$request->validate([
    		'category_id'=>'required',
    		'subcategory_name'=>'required'
    	]);
    	$data= array();
    	$data['category_id']=$request->category_id;
    	$data['subcategory_name']=$request->subcategory_name;

    	$sub_category=DB::table('subcategories')->update($data);
    	$notification= array(
            'message'=>'Subcategory Edited',
            'alert-type'=>'success'
        );

        return Redirect()->route('subCategories')->with($notification);

    }
}
