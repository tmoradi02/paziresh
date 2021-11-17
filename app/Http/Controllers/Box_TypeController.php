<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box_Type;
use Illuminate\Support\Facades\Gate;
use App\User;
use Illuminate\Validation\Rule;

class Box_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Box_Type')) return abort(403,'عدم دسترسی');
        {
            $box_types = Box_Type::all();
            // dd($box_types);
            return view('box_type.index',['box_types'=> $box_types]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('Insert_Box_Type')) return abort(403,'عدم دسترسی');
        {
            $users = User::all();
            // dd($users->all());
            return view('box_type.create' ,['users'=> $users]);
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
        $request->validate([
            'box_type' => 'required|min:3|unique:box_type',
        ]);

        if(!Gate::allows('Insert_Box_Type')) return abort(403,'عدم دسترسی');
        {
            $box_type = new Box_Type();
            $box_type->box_type = trim($request->box_type);
            $box_type->user_id = $request->user_id;
            $box_type->save();
            return redirect()->route('box_type.index');
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
        if(!Gate::allows('Edit_Box_Type')) return abort(403,'عدم دسترسی');
        {
            $box_type = Box_Type::findOrFail($id);
            $users = User::all();
            // dd($box_type);
            return response()->json($box_type);

            // return view('box_type.edit', ['box_type' => $box_type ,'users' => $users]);
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
        $box_type_Validate = Box_Type::findOrFail($id);
        $request->validate([
            'box_type' => [
                'required' ,
                'min:3' , 
                Rule::unique('box_type')->ignore($box_type_Validate->id),
            ] , 
        ]);
            
        if(!Gate::allows('Edit_Box_Type'))return abort(403,'عدم دسترسی');
        {
            $box_type = Box_Type::findOrFail($id);
            $box_type->box_type = trim($request->box_type);

            dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
            $box_type->user_id = $request->user_id;

            
            $box_type->save();

            // dd($request->all());
            return redirect()->back()->with('message' , 'ثبت با موفقست انجام شد');
            // return redirect()->route('box_type.index');
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
        if(!Gate::allows('Delete_Box_Type')) return abort(403,'عدم دسترسی');
        {
            $box_type = Box_Type::destroy($id);
            return redirect()->back();
        }
    }
}

