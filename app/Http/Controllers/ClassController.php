<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Classes; 
use App\User; 
use App\Channel;  // ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات
use Illuminate\Support\Facades\Gate; 
use Illuminate\Validation\Rule; 

class ClassController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Classes')) return abort(403,'عدم دسترسی');
        {
            $classes = Classes::all();
            $channels = Channel::all();  // ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات  
            $users = User::all(); 

            return view('classes.index',['classes'=> $classes , 'channels' => $channels , 'users' => $users]); // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات
            // return view ('classes.index' , ['classes' => $classes , 'users' => $users]); ST LOCK 1400-09-08 بدلیل اضافه شدن ریلیشن شبکه به جدول طبقات
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('cre');
        if(!Gate::allows('Insert_Classes')) return abort(403,'عدم دسترسی');
        {
            $channels = Channel::all(); // ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات
            $users = User::all();

            return view('classes.create' ,['channels' => $channels , 'users'=> $users]); // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات
            // return view('classes.create' , ['users' => $users]); ST LOCK 1400-09-08 بدلیل اضافه نمودن ریلیشن شبکه به این جدول
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request->all());

        $request->validate([ 
            'channel_id' => 'required' , 
            'class_name' => 'required|min:1|unique:classes', 
        ]); 
        
        // dd($request->all());

        if(!Gate::allows('Insert_Classes')) return abort (403,'عدم دسترسی'); 
        {
            $classe = new Classes(); 
            $classe->channel_id = $request->channel_id; // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات 

            $classe->class_name = trim($request->class_name); 

            // ST DOC 1400-09-21 با هر کاربر لاگین کنیم با آیدی همان کاربر ثبت می کند
            $classe->user_id = $request->user()->id; // $request->user_id; 
            // $classe->user_id = auth()->user()->id;

            $classe->save(); 
            
            return redirect()->route('classes.index'); 
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        if(!Gate::allows('Edit_Classes')) return abort(403,'عدم دسترسی');
        {
            $classe = Classes::findOrFail($id);
            $users = User::all();
            
            return response()->json($classe);
            // return view('classes.edit',['classe'=> $classe , 'users'=> $users ]);
        }
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
        $class_Validate = Classes::findOrFail($id);
        $request->validate([
            'class_name' => [
                'required' ,
                'min:1' ,
                Rule::unique('classes')->ignore($class_Validate->id)
            ],
            ]);

        if(!Gate::allows('Edit_Classes')) return abort(403,'عدم دسترسی');
        {
            $classe = Classes::findOrFail($id);
            $classe->class_name = $request->class_name;
            $classe->user_id = $request->user_id;
            $classe->save();
            // dd($classe->all());
            return redirect()->back()->with('message' , 'OK');
            // return redirect()->route('classes.index');
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
        if(!Gate::allows('Delete_Classes')) return abort(403,'عدم دسترسی');
        {
            $classe = Classes::destroy($id);
            return redirect()->back();
        }
    }

    public function search (Request $request)
    {
        $channels = Channel::all();  // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات
        $users = User::all(); 
        $classes = Classes::query();

        // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات
        if($request->has('channel_id') && $request->channel_id)
        {
            $classes->where('channel_id' , $request->channel_id);
        }
        // END DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات

        if($request->has('class_name') && $request->class_name)        
        {
            $classes->where('class_name' , 'like' , "%$request->class_name%");
        }

        $classes = $classes->get();
        return view('classes.index' , ['classes' => $classes , 'channels' => $channels , 'users' => $users]); // ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات
        // return view('clsses.index' , ['classes' => $classes  , 'users' => $users]); ST LOCK 1400-09-08 
    }

}


