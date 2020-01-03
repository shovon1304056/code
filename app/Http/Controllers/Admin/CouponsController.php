<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Model\Admin\Coupon;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CouponsController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
    	$coupons = Coupon::all();
    	return view('admin.coupon.coupon',compact('coupons'));
    }

    public function store_coupon(Request $request){

        $validatedData = $request->validate([
        'discount' => 'required',
        'coupon_code' =>'required'
    ]);

        $data = array();
        $data['coupon']=$request->coupon_code;
        $data['discount']=$request->discount;
        $coupon = DB::table('coupons')->insert($data);

    
            # code...
            $notification= array(
            'message'=>'Coupon Inserted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function delete_coupon($id)
    {
    	$coupon = Coupon::findorFail($id);
    	//$sub_category = DB::table('subcategories')->where('id',$id)->first();
    	$coupon->delete();
    	$notification= array(
            'message'=>'Subcategory Deleted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function edit_coupon($id)
   {
    // $coupon = Coupon::findorFail($id);
    $coupon = DB::table('coupons')->where('id',$id)->first();
    return view('admin.coupon.edit_coupon',compact('coupon'));
   }

   public function update_coupon(Request $request,$id)
   {
        $coupon = Coupon::findorFail($id);
        $coupon->coupon=$request->coupon_code;
        $coupon->discount=$request->discount;
        $coupon->save();

    
            # code...
            $notification= array(
            'message'=>'Coupon Inserted',
            'alert-type'=>'success'
        );

        return Redirect()->route('coupons')->with($notification);
   }
}
