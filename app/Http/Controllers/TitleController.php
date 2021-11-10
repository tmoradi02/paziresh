<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use App\User;
use Illuminate\Support\Facades\Gate;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Title')) return abort(403,'عدم دسترسی');
        {
            $titles = Title::all();
            return view('title.index',['titles' => $titles]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $users = User::all();
        if($id == null && Gate::allows('Insert_Title'))
        {
            $title = (object)[];
            $status = 'insert';
        }
        elseif($id != null && Gate::allows('Edit_Title'))
        {
            $title = Title::findOrFail($id);
            $status ='update';
        }
        else
        {
            return abort(403,'عدم دسترسی');
        }
        return response()->json($title);

        // return view('title.create' , ['title' => $title , 'users' => $users , 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        $request->validate([
            'title' => 'required|min:3|max:30',
        ]);

        if($id == null && Gate::allows('Insert_Title'))
        {
            $title = new Title();
        }
        elseif($id != null && Gate::allows('Edit_Title'))
        {
            $title = Title::findOrFail($id);
        }
        else 
        {
            return abort(403,'عدم دسترسی');
        }
        $title->title = trim($request->title);
        $title->user_id = $request->user_id;
        $title->save();
        
        // dd($request->all());
        
        return redirect()->back()->with('message' , 'ثبت با موفقیت انجام شد');
        // return redirect()->route('title.index');
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

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('Delete_Title'))return abort(403,'عدم دسترسی');
        {
            $title = Title::destroy($id);
            return redirect()->back();
        }
    }
}

