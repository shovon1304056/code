<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Model\Admin\Brand;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function brand()
    {
    	$brands = Brand::all();
    	return view('admin.category.brand',compact('brands'));
    }

     public function storeBrand(Request $request){
     	$request->validate([
     		'brand_name'=>'required|unique:brands|max:55',
     		'brand_logo' =>'required'
     	]);

     	$data= array();
     	$data['brand_name']=$request->brand_name;

     	$image = $request->file('brand_logo');
        $slug = Str::slug($request->brand_name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/media/brands')) {
                mkdir('public/media/brands', 0777, true);
            }
            $image->move('public/media/brands', $imageName);
        } else {
            $imageName = 'default.png';
}
     	$data['brand_logo']=$imageName;

     	$brand = DB::table('brands')->insert($data);

     	$notification= array(
            'message'=>'Brand Inserted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
     }

     public function deleteBrand ($id){
     	$data=DB::table('brands')->where('id',$id)->first();

     	if (file_exists('public/media/brands/' . $data->brand_logo)) {
            unlink('public/media/brands/' . $data->brand_logo);
        }

     	$brand=DB::table('brands')->where('id',$id)->delete();

     	$notification= array(
            'message'=>'Brand Deleted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);

     }
	 public function editBrand($id)
		   {
		   $brand=DB::table('brands')->where('id',$id)->first();
		    return view('admin.category.update_brand',compact('brand','id'));
		   }

	public function updatcBrand(Request $request, $id)
    {
        //
         $validatedData = $request->validate([
        'brand_name' => 'required|max:55',
       
    ]);
         $oldLogo = $request->old_logo;
         $data= array();
     	$data['brand_name']=$request->brand_name;

     	$image = $request->file('brand_logo');
     	if ($image) {
     		
          unlink('public/media/brands/' . $oldLogo);

         $slug = Str::slug($request->brand_name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('public/media/brands')) {
                mkdir('public/media/brands', 0777, true);
            }
            $image->move('public/media/brands', $imageName);
        } 
     	
        
     	$data['brand_logo']=$imageName;

     	$brand = DB::table('brands')->where('id',$id)->update($data);
         
         if($brand){
            $notification= array(
            'message'=>'Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->route('brands')->with($notification);
         }
     }
     else{
     	$brand = DB::table('brands')->where('id',$id)->update($data);
         
         if($brand){
            $notification= array(
            'message'=>'Category Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->route('brands')->with($notification);
         }
     }
    }
}
