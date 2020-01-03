<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

class ProductsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    
    public function allProducts(){
    	
    	$products = DB::table('products')
    				->join('categories','products.category_id','categories.id')
    				->join('brands','products.brand_id','brands.id')
    				->select('products.*','categories.category_name','brands.brand_name')
    				->where('status',1)
    				->get();
    	dd($products);
    	//return response()->json($products);
    	//return view('admin.product.index');
    }
    public function addProducts(){
    	$category = DB::table('categories')->get();
    	$brand = DB::table('brands')->get();
    	return view('admin.product.create',compact('category','brand'));
    }


    /// get Subcategory with ajax
    public function getSubCategory($category_id){
    	$cat = DB::table('subcategories')->where('category_id',$category_id)->get();
    	return json_encode($cat);
    }

    public function store_product(Request $request)
    {
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$data['product_code']=$request->product_code;
    	$data['product_quantity']=$request->product_quantity;
    	$data['category_id']=$request->category_id;
    	$data['subcategory_id']=$request->subcategory_id;
    	$data['brand_id']=$request->brand_id;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['selling_price']=$request->selling_price;
    	$data['product_details']=$request->product_details;
    	$data['video_link']=$request->video_link;
    	$data['main_slider']=$request->main_slider;
    	$data['hot_deal']=$request->hot_deal;
    	$data['best_rated']=$request->best_rated;
    	$data['trend']=$request->trend;
    	$data['mid_slider']=$request->mid_slider;
    	$data['hot_new']=$request->hot_new;
    	$data['status']=1;

    	$image_one = $request->file('image_one');
    	$image_two = $request->file('image_two');
    	$image_three = $request->file('image_three');

    	/*$slug1= Str::slug($request->product_name);
    	$slug2= Str::slug($request->product_name);

        if ($image_one && $image_two) {
            $currentDate1 = Carbon::now()->toDateString();
            $currentDate2 = Carbon::now()->toDateString();

            $image_one_name = $slug1 .'-' .$currentDate1 . '-' . uniqid() . '.' . $image_one->getClientOriginalExtension();

            $image_two_name = $slug2 .'-' .$currentDate2 . '-' . uniqid() . '.' . $image_two->getClientOriginalExtension();
            if (!file_exists('public/media/products')) {
                mkdir('public/media/products', 0777, true);
            }
            $image_one->move('public/media/products', $image_one_name);
            $image_two->move('public/media/products', $image_two_name);
        }

    	//return response()->json($data);
        $data['image_one']=$image_one_name;
        $data['image_two']=$image_two_name;*/
        //$data['image_one']=$image_one;

        	/////image intervation process

        if ($image_one && $image_two && $image_three) {
        	$image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        	Image::make($image_one)->resize(300,300)->save('public/media/products/'.$image_one_name);
        	$data['image_one']='public/media/products/'.$image_one_name;

        	$image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        	Image::make($image_two)->resize(300,300)->save('public/media/products/'.$image_two_name);
        	$data['image_two']='public/media/products/'.$image_two_name;


        	$image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        	Image::make($image_three)->resize(300,300)->save('public/media/products/'.$image_three_name);
        	$data['image_three']='public/media/products/'.$image_three_name;



        }


    	$product = DB::table('products')->insert($data);
    	 $notification=array(
                     'messege'=>'Successfully Product Inserted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);   
        



    }
}
