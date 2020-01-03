<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Model\Newslaters;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewslatersBackendController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newslaters()
    {
    	$newslaters = DB::table('newslaters')->get();
    	return view('admin.newslaters.newslaters',compact('newslaters'));
    }

    public function delete_newslater($id)
    {
    	$newslater = DB::table('newslaters')->where('id',$id)->delete();
    	 $notification= array(
            'message'=>'Subscribed Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}
