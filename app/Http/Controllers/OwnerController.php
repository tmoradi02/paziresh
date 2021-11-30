<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Redirector;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Owner')) return abort(403,'عدم دسترسی');
        {
            $owners = Owner::all();
            $users = User::all();
            return view('owner.index' , ['owners'=> $owners , 'users'=> $users]);
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
        
        if($id == null && Gate::allows('Insert_Owner'))
        {
            $owner = (object)[];
            $status = 'insert';
        }
        elseif($id != null && Gate::allows('Edit_Owner'))
        {
            $owner = Owner::findOrFail($id);
            $status = 'update';
        }
        else
        {
            return abort(403 , 'عدم دسترسی');
        }
        return response()->json($owner); 
        // return view('owner.create', ['owner' => $owner , 'users' => $users , 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        if($id == null && Gate::allows('Insert_Owner'))
        {
            $request->validate([
                'owner' => 'required|unique:owners|min:3',
            ]);
            $owner = new Owner();
        }
        elseif($id != null && Gate::allows('Edit_Owner'))
        {
            $owner = Owner::findOrFail($id);
            $request->validate([
                'owner' => [
                    'required',
                    'min:3',
                    Rule::unique('owners')->ignore($owner->id),
                ],
            ]);
        }
        else
        {
            return abort (403,'عدم دسترسی');
        }
        $owner->owner = $request->owner;
        $owner->manager_owner = $request->manager_owner;
        $owner->tell_owner = $request->tell_owner;
        $owner->fax_owner = $request->fax_owner;
        $owner->email_owner = $request->email_owner;
        $owner->address_owner = $request->address_owner;
        $owner->kind_group = $request->kind_group;
        $owner->description_owner = $request->description_owner;

        // dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
        $owner->user_id = $request->user_id;

        $owner->save();
        return redirect()->route('owner.index');
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
        if(!Gate::allows('Delete_Owner'))return abort(403,'عدم دسترسی');
        {
            $owner = Owner::destroy($id);
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $users = User::all();
        $owners = Owner::query();

        if($request->has('owner') && $request->owner)
        {
            $owners->where('owner' , 'like' , "%$request->owner%");
        }
        if($request->has('manager_owner') && $request->manager_owner)
        {
            $owners->where('manager_owner' , 'like' , "%$request->manager_owner%");
        }
        if($request->has('tell_owner') && $request->tell_owner)
        {
            $owners->where('tell_owner' , 'like' , "%$request->tell_owner%");
        }
        if($request->has('fax_owner') && $request->fax_owner)
        {
            $owners->where('fax_owner' , 'like' , "%$request->fax_owner%");
        }
        if($request->has('email_owner') && $request->email_owner)
        {
            $owners->where('email_owner' , 'like' , "%$request->email_owner%");
        }
        if($request->has('address_owner') && $request->address_owner)
        {
            $owners->where('address_owner' , 'like' , "%$request->address_owner%");
        }
        if($request->has('kind_group') && $request->kind_group)
        {
            $owners->where('kind_group' , 'like' , "%$request->kind_group%");
        }
        if($request->has('description_owner') && $request->description_owner)
        {
            $owners->where('description_owner' , 'like' , "%$request->description_owner%");
        }

        if($request->has('user_id') && $request->user_id)
        {
            $owners->where('user_id' , $request->user_id);
        }

        $owners = $owners->get();
        return view('owner.index' , ['owners' => $owners , 'users'=> $users]);
    }
    
}
