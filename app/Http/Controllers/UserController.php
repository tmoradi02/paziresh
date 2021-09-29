<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Channel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_User')) return abort(403,'عدم دسترسی');
        {
            $permissions = Permission::all();
            $users = User::all();
            // dd($user);
            return view('user.index',['users'=> $users , 'permissions' => $permissions]); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('Insert_User')) return abort(403, 'عدم دسترسی');
        {
            $permissions = Permission::all();
            return view('user.create',['permissions'=> $permissions]);
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
            'name' => 'required|min:3|string' ,
            'email' => 'required|min:14|unique:users|email|string' ,  
            'password' => 'required|min:8|string' ,
            'tell'=> 'required|min:11|numeric|unique:users' ,
        ]);

        if(!Gate::allows('Insert_User')) return abort(403,'عدم دسترسی');
        {
            // dd($request->all());
            $user = new User();
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->status = trim($request->status) ; 
            $user->tell = trim($request->tell);
            if($request->password !== null) $user->password = Hash::Make($request->password);
            $user->save();
            // dd($user);
            $user->roles()->sync($request->prm);
            return redirect()->route('user.index');
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
        if(!Gate::allows('Edit_User')) return abort(403,'عدم دسترسی');
        {
            $user = User::findOrFail($id);
            $permissions = Permission::all();
            return view('user.edit',['user'=>$user , 'permissions'=> $permissions]);
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
        $user_Validate = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|string' ,
            'email' => [
                'required',
                'min:14',
                'email',
                Rule::unique('users')->ignore($user_Validate->id),
            ],
            // 'password' => 'required|min:8' ,
            'tell' => [
                'required',
                'min:11',
                'numeric',
                Rule::unique('users')->ignore($user_Validate->id),
            ],
        ]);
        
        if(!Gate::allows('Edit_User')) return abort(403,'عدم دسترسی');
        {
            $user = User::findOrFail($id);
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->tell = trim($request->tell) ;
            $user->status = $request->status ;
            if($request->password !==null) $user->password = Hash::Make($request->password);
            $user->save();
            $user->roles()->sync($request->prm);
            return redirect()->route('user.index');
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
        // به هیچ عنوان حذف کاربر نباید انجام شود، فقط کاربر را غیر فعال می کنیم
        if(!Gate::allows('Delete_User')) return abort(403,'عدم دسترسی');
        {
            $user = User::findOrFail($id);
            foreach($user->channels as $channel)
            {
                $c = Channel::findOrFail($channel->id);
                $c->user_id = 11;  // User Admin
                $c->save();
            }
            $user->channels()->delete();
            $user->roles()->sync([]);
            $user->delete();
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $permissions = Permission::all();
        $users = User::query();

        // dd($request);

        if($request->has('name') && $request->name)
        {
            $users->where('name' , 'like' , "%$request->name%");
        }

        if($request->has('email') && $request->email)
        {
            $users->where('email' , 'like' , "%$request->email%");
        }
        
        if($request->has('status')) // && $request->status 
        {
            $users->where('status' , '=' ,$request->status);
        }
        
        if($request->has('tell') && $request->tell)
        {
            $users->where('tell' , 'like' , "%$request->tell%");
        }

        // Search Permission 
        if($request->has('permission_id') && $request->permission_id)
        {
            $users->where('permission_id' , $request->permission_id);
        }
        // Search Permission 

        $users = $users->get();
        return view('user.index' , ['users' => $users , 'permissions' => $permissions]);
    }

    public function Search_gen(Request $request)
    {
        $permission_user = Permission_user::all();
        $permissions = Permission::all();
        $users = User::all();
        if($request->has('permission_name') && $request->permission_name)
        {
            $users = $request->where('permission_name' , 'like' , "%permission_name%");
        }
        if($request->has('email') && $request->email)
        {
            $users = $request->where('email' , 'like' , "%$request->email%");
        }
        $users = $users->get();
        return view('user.index' , ['users' => $users , 'permission_user' => $permission_user , 'permissions' => $permissions]);

    }

    public function Test_Mw()
    {
        // This is a Test For Git Hub Project Upload
    }
}



