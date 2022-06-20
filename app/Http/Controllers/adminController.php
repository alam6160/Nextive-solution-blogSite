<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blogPost;
use toaster;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $blog=blogPost:: latest()-> paginate(10);
       return view('admin.home',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
       

        $blog = new blogPost;
        $blog->title= $request->input('title');
        $blog->description= $request->input('description');
        
    
        if($request->hasfile('pic'))
        {
            $file = $request->file('pic');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('images/', $filename);
            $blog->thumbnail = $filename;
        }
        $blog->save();
       
        Toastr::success('Data added successfully', 'Title', ["positionClass" => "toast-top-right","closeButton"=>"true","progressBar"=> "true" ]);
        return redirect('admin.home')->with('success', 'Data created successfully.');


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
         $blog= blogPost::find($id);
        return view('admin.edit',compact('blog'));
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
        $blog = blogPost::find($id);
        $blog->title= $request->input('title');
        $blog->description= $request->input('description');

        if($request->hasfile('pic'))
        {

            $destination = 'images/'. $blog->pic;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('pic');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('images/', $filename);
             $blog->pic = $filename;
        }
        $blog->save();
        Toastr::success('Data updated successfully', 'Title', ["positionClass" => "toast-top-right","closeButton"=>"true","progressBar"=> "true" ]);
        return redirect('view-data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $blog = blogPost::find($id);
        $destination = 'images/'.$blog->pic;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
         $blog->delete();
     
       Toastr::success('Data deleted successfully', 'Title', ["positionClass" => "toast-top-right","closeButton"=>"true","progressBar"=> "true" ]);
       return redirect()->back();
    }
}
