<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Admin\Category;
use Illuminate\Support\Facades\DB;
//use DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        //
       $category= Category::findorFail($id);
        $category->delete();
        //return redirect()->route('category.index')->with('success','Data Deleted');*/

        //DB::table('categories')->where('id',$id)->delete();
        $notification=array(
                     'messege'=>'Successfully Category Deleted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);



    
    }

    public function category(){
        $category = Category::all();

        return view('admin.category.category',compact('category'));
    }

    public function storecategory(Request $request){

        $validatedData = $request->validate([
        'category_name' => 'required|unique:categories|max:55',
    ]);

        $categories = new Category();
        $categories->category_name = $request->category_name;
        $categories->save();
    
            # code...
            $notification=array(
                     'messege'=>'Successfully Category Inserted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);
    }


    public function deletecategory($id){
       DB::table('categories')->where('id',$id)->delete();
        $notification=array(
                     'messege'=>'Successfully Category Deleted ',
                     'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification);
    }

   public function editcategory($id)
   {
    $category = Category::findorFail($id);
    return view('admin.category.update_category',compact('category','id'));
   }

   
    public function updatecategory(Request $request, $id)
    {
        //
         $validatedData = $request->validate([
        'category_name' => 'required|max:55',
    ]);

         $category= Category::findorFail($id);
         $category->category_name=$request->category_name;
         $category->save();

         if($category){
            $notification=array(
                     'messege'=>'Successfully Category Updated ',
                     'alert-type'=>'success'
                    );
                return Redirect()->route('categories')->with($notification);
        
         }
    }
}
