<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

use App\Model\Newslaters;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewslatersController extends Controller
{
    //

    public function store_newslaters(Request $request)
    {
		$validatedData = $request->validate([
        'newslater_email' => 'required|max:55',
        
    ]);

        $data = array();
        $data['email']=$request->newslater_email;
       $newslater = DB::table('newslaters')->insert($data);
    
            # code...
            $notification= array(
            'message'=>'Subscribed Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}
