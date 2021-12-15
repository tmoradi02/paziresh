<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Channel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\classes;
use App\Adver_Type;
use App\Adver_Type_Coef;
use App\Box_Prog_Group;
use App\Cast;
use App\Owner;
use App\Product;
use App\Title;
use App\ArmAgahi;
use App\Box_Type;


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
            $users = User::all();

            return response()->json(['users' => $users , 'permissions' => $permissions]);
        
            // return view('user.create',['permissions'=> $permissions]);
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

        if(!Gate::allows('Insert_User')) return abort(403,'عدم دسترسی');
        {
            $request->validate([
                'name' => 'required|min:3|string' ,
                'email' => 'required|min:14|unique:users|email|string' ,  
                'password' => 'required|min:8|string' ,
                'tell'=> 'required|min:11|numeric|unique:users' ,
            ]);

            // dd($request->all());
            $user = new User();
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->status = trim($request->status); 
            $user->tell = trim($request->tell);
            if($request->password !== null) $user->password = Hash::Make($request->password);

            // dd($request->all());

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
            // return view('user.edit',['user'=>$user , 'permissions'=> $permissions]); 
            return response()->json(['user' => $user , 'permissions' => $permissions]); 
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

            // Check for UserId In Channel Table
            foreach($user->channels as $channel)
            {
                $c = Channel::findOrFail($channel->id);
                $c->user_id = 11;  // User Admin
                $c->save();
            }
            $user->channels()->delete();

            // Check for UserId In classes Table
            foreach($user->class as $classes)
            {
                $cl = classes::findOrFail($classes->id);
                $cl->user_id = 11;
                $cl->save();
            }
            $user->class()->delete();

            // Check for UserId In adver_types Table 
            foreach($user->adver_type as $adver_types)
            {
                $ad_type = Adver_Type::findOrFail($adver_types->id);
                $ad_type->user_id = 11;
                $ad_type->save();
            }
            $user->adver_type()->delete();

            // Check for UserId In adver_type_coef Table
            foreach($user->adver_type_coef as $adver_type_coefs)
            {
                $ad_type_coef = Adver_Type_Coef::findOrFail($adver_type_coefs->id);
                $ad_type_coef->user_id = 11;
                $ad_type_coef->save();
            }
            $user->adver_type_coef()->delete();

            // Check for UserId In arm_agahi Table
            foreach($user->arm_Agahi as $arm_Agahis)
            {
                $arm = ArmAgahi::findOrFail($arm_Agahis->id);
                $arm->user_id = 11 ;
                $arm->save();
            }
            $user->arm_Agahi()->delete();

            // Check for User_id In box_prog_group Table 
            foreach($user->box_prog_group as $box_prog_groups)
            {
                $box_prog = Box_Prog_Group::findOrFail($box_prog_groups->id);
                $box_prog->user_id = 11;
                $box_prog->save();
            }
            $user->box_prog_group()->delete();

            // Check for UserId In box_type Table
            foreach($user->box_types as $box_type)
            {
                $boxtype = Box_Type::findOrFail($box_type->id);
                $boxtype->user_id = 11;
                $boxtype->save();
            }
            $user->box_types()->delete();


            // Check for UserId In casts Table
            foreach($user->cast as $casts)
            {
                $castt = Cast::findOrFail($casts->id);
                $castt->user_id = 11;
                $castt->save();
            }
            $user->cast()->delete();

            // check for UserId In owners Table
            foreach($user->owner as $owners)
            {
                $own = Owner::findOrFail($owners->id);
                $own->user_id = 11;
                $own->save();
            }
            $user->owner()->delete();

            // Check for UserId In products Table
            foreach($user->product as $products)            
            {
                $pro = Product::findOrFail($products->id);
                $pro->user_id = 11;
                $pro->save();
            }
            $user->product()->delete();

            // Check for UserId In titles Table
            foreach($user->title as $titles)
            {
                $titl = Title::findOrFail($titles->id);
                $titl->user_id = 11;
                $titl->save();
            }
            $user->title()->delete();

            // Check for UserId In tariff Table
            foreach($user->tariff as $tariff)
            {
                $tariff = Tariff::findOrFail($tariff->id);
                $tariff->user_id = 11;
                $tariff->save();
            }

            // تمام این مراحل رو طی میکند بعد نام کاربر را حذف میکند

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


}



