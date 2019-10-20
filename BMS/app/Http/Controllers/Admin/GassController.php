<?php

namespace App\Http\Controllers\Admin;

use App\Gass;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gasses = Gass::orderBy('updated_at','DESC')->get();
        return view('admin.gass.index',compact('gasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.gass.create');
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
           'g_date'=>'required',
           'g_amount'=>'required',
           'g_file'=>'required'
        ]);

        $file = $request->file('g_file');
        $slug = Str::slug($request->g_file->getClientOriginalName());

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

        $gass = new  Gass();

        $gass->g_date = $request->g_date;
        $gass->g_amount = $request->g_amount;
        $gass->g_file = $fileName;

        $gass->save();

        if ($gass)
        {
            return redirect()->route('gass.index')->with('success','Record Added');
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
        $gass = Gass::findorFail($id);
        return view('admin.gass.show',compact('gass','id'));
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
        $gass = Gass::findorFail($id);
        return view('admin.gass.edit',compact('gass','id'));
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
           'g_date'=>'required',
           'g_amount'=>'required',
           'g_file'=>'required'
        ]);

        $gass = Gass::findorFail($id);

        $file = $request->file('g_file');
        $slug = Str::slug($request->g_file->getClientOriginalName());

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

        $gass->g_date = $request->g_date;
        $gass->g_amount = $request->g_amount;
        $gass->g_file = $fileName;

        $gass->save();

        if ($gass)
        {
            return redirect()->route('gass.index')->with('success','Data Edited');
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
        $gass = Gass::findorFail($id);

        if (file_exists('uploads/file/'.$gass->g_file))
        {
            unlink('uploads/file/'.$gass->g_file);
        }

        $gass->delete();

        return redirect()->route('gass.index')->with('success','Record Deleted');
    }
}
