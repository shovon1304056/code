<?php

namespace App\Http\Controllers\Admin;

use App\Electricity;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ElectricityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $electricities= Electricity::all();
        return view('admin.electricity.index',compact('electricities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.electricity.create');
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
        $request->validate([
           'e_date'=>'required',
           'e_amount'=>'required',
           'e_file'=>'required'
        ]);
        $file= $request->file('e_file');
        $slug = Str::slug($request->e_file->getClientOriginalName());
        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $fileName = $slug .'-'. $currentDate .'-'. uniqid() .'.'. $file->getClientOriginalExtension();
            if (!file_exists('uploads/file')){
                mkdir('uploads/file',0777,true);
            }
            $file->move('uploads/file',$fileName);
        }
        else
        {
            $fileName= 'default.abc';
        }

        $electricity = new Electricity();
        $electricity->e_date = $request->e_date;
        $electricity->e_amount = $request->e_amount;
        $electricity->e_file = $fileName;

        $electricity->save();

        if($electricity)
        {
            return redirect()->route('electricity.index')->with('success','Data Added');
        }

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
        $electricity = Electricity::findorFail($id);
        return view('admin.electricity.show',compact('electricity','id'));
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
        $electricity = Electricity::findorFail($id);
        return view('admin.electricity.edit',compact('electricity','id'));
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
        $request->validate([
           'e_date'=>'required',
           'e_amount'=>'required',
           'e_file'=>'required',
        ]);

        $electricity = Electricity::findorFail($id);

        $file = $request->file('e_file');
        $slug = Str::slug($request->e_amount);

        if (isset($file))
        {
            $current_date = Carbon::now()->toDateString();
            $fileName = $slug .'-'. $current_date .'-'. uniqid() .'.'. $file->getClientOriginalExtension();

            if (!file_exists('uploads/file'))
            {
                mkdir('uploads/file',0777,true);
            }
            $file->move('uploads/file',$fileName);

        }
        else{
            $fileName = 'default.abc';
        }

        $electricity->e_date = $request->e_date;
        $electricity->e_amount = $request->e_amount;
        $electricity->e_file = $fileName;


        $electricity->save();
        //dd($electricity);
        if ($electricity)
        {
           // return 1;
            return redirect()->route('electricity.index')->with('success',"Data Edited");
        }
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
        $electricity = Electricity::findorFail($id);

        if (file_exists('uploads/file/'.$electricity->e_file))
        {
            unlink('uploads/file/'.$electricity->e_file);
        }
        $electricity->delete();

        return redirect()->route('electricity.index')->with('success','Data Deleted');
    }
}
