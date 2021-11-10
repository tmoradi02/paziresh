<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box_Prog_Group;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class Box_Prog_GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Box_Prog_Group')) return abort(403,'عدم دسترسی');
        {
            $box_prog_groups = Box_Prog_Group::all();
            // dd($box_prog_groups);
            return view('box_prog_group.index',['box_prog_groups'=> $box_prog_groups]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('Insert_Box_Prog_Group')) return abort(403,'عدم دسترسی');
        {
            $users = User::all();
            // dd($users->all());
            return view('box_prog_group.create',['users'=> $users]);
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
            'prog_group' => 'required|unique:box_prog_group|min:3|string',
        ]);
        if(!Gate::allows('Insert_Box_Prog_Group')) return abort(403,'عدم دسترسی');
        {
            $box_prog_group = new Box_Prog_Group();
            $box_prog_group->prog_group = trim($request->prog_group);
            $box_prog_group->user_id = $request->user_id;
            $box_prog_group->save();

            return redirect()->route('box_prog_group.index');
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
        if(!Gate::allows('Edit_Box_Prog_Group'))return abort(403,'عدم دسترسی');
        {
            $box_prog_group = Box_Prog_Group::findOrFail($id);
            $users = User::all();
            // dd($users->all());

            return response()->json($box_prog_group);

            // return view('box_prog_group.edit',['box_prog_group'=> $box_prog_group , 'users'=> $users]);
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
        $box_prog_Validate = Box_Prog_Group::findOrFail($id);
        $request->validate([
            'prog_group' => [
                'required' ,
                'min:3' , 
                'string' ,
                rule::unique('box_prog_group')->ignore( $box_prog_Validate->id),
            ], 
        ]);

        if(!Gate::allows('Edit_Box_Prog_Group'))return abort(403,'عدم دسترسی');
        {
            $box_prog_group = Box_Prog_Group::findOrFail($id);
            $box_prog_group->prog_group = trim($request->prog_group);
            $box_prog_group->user_id = $request->user_id;
            $box_prog_group->save();

            // dd($request->all());
            
            return redirect()->back()->with('message' , 'OK');

            // return redirect()->route('box_prog_group.index');
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
        if(!Gate::allows('Delete_Box_Prog_Group')) return abort(403,'عدم دسترسی');
        {
            $box_prog_group = Box_Prog_Group::destroy($id);
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $box_prog_groups = Box_Prog_Group::query();

        if($request->has('prog_group') && $request->prog_group)
        {
            $box_prog_groups->where('prog_group' , 'like' , "%$request->prog_group%");
        }
        
        $box_prog_groups = $box_prog_groups->get();
        // dd($box_prog_groups);
        return view('box_prog_group.index' , ['box_prog_groups' => $box_prog_groups]);
    }

}



