<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArmAgahi;
use App\Channel;
use App\User;
use Illuminate\Support\Facades\Gate;
use Hekmatinasser\Verta\Verta;

class ArmAgahiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_ArmAgahi')) return abort(403,'عدم دسترسی');
        {
            $arm_agahies = ArmAgahi::all();
            $channels = Channel::all();
            $users = User::all();
            return view ('arm_agahi.index' , ['arm_agahies' => $arm_agahies , 'channels'=> $channels , 'users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('Insert_ArmAgahi')) return abort(403,'عدم دسترسی');
        {
            $channels = Channel::all();
            $users = User::all();
            return view('arm_agahi.create',['channels'=> $channels , 'users' => $users ]);
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
        // باید ابتدا چک شود مثلا در شبکه اول داخل یک بازه زمانی چند تا رکورد ثبت نگردد

        $request->validate([
            'coef' => 'required|min:1|max:3|gt:0|between:1,200' , // |numeric
            'from_date' => 'required',  // |date
            'to_date' => 'required'  // |date 
        ]);

        if(!Gate::allows('Insert_ArmAgahi')) return abort(403,'عدم دسترسی');
        {
            $arm_agahi = new ArmAgahi();
            $arm_agahi->channel_id = $request->channel_id;
            if(trim($request->coef) <> 0 ) $arm_agahi->coef = trim($request->coef);
            // dd(str_replace("/" , "-" , $request->from_date));
            $arm_agahi->from_date =  $request->from_date; // str_replace("/" , "-" , $request->from_date); // "1400/07/01";  //$request->from_date;
            // dd($request->to_date);
            $arm_agahi->to_date = $request->to_date; // str_replace("/" , "-" , $request->to_date); // "1400/07/30";  //$request->to_date;
            $arm_agahi->user_id = $request->user_id;
            $arm_agahi->save();
            return redirect()->route('arm_agahi.index');
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
        if(!Gate::allows('Edit_ArmAgahi')) return abort(403,'عدم دسترسی');
        {
            $arm_agahi = ArmAgahi::findOrFail($id);
            $channels = Channel::all();
            $users = User::all();
            // dd($channels);
            return view('arm_agahi.edit',['arm_agahi'=> $arm_agahi ,'channels'=> $channels , 'users' => $users ]);
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
        // dd($id);
        $request->validate([
            'coef' => 'required|min:1|max:3|gt:0|between:1,200' , // |min:1|max:3|numeric|gt:0' ,
            'from_date' => 'required', // |date
            'to_date' => 'required' ,  // |date
        ]);

        if(!Gate::allows('Edit_ArmAgahi')) return abort(403 , 'عدم دسترسی');
        {
            $arm_agahi = ArmAgahi::findOrFail($id);
            $arm_agahi->channel_id = $request->channel_id;
            $arm_agahi->coef = trim($request->coef);
            $arm_agahi->from_date = $request->from_date;
            $arm_agahi->to_date = $request->to_date;
            $arm_agahi->user_id = $request->user_id;
            $arm_agahi->save();
            return redirect()->route('arm_agahi.index');
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
        if(!Gate::allows('Delete_ArmAgahi')) return abort(403 , 'عدم دسترسی');
        {
            $arm_agahi = ArmAgahi::destroy($id);
            return redirect()->back();
        }
    }
    
    
    public function search(Request $request)
    {
        $channels = Channel::all();
        $users = User::all();
        $arm_agahies = ArmAgahi::query();

        if($request->has('channel_id') && $request->channel_id)
        {
            $arm_agahies->where('channel_id' , $request->channel_id);
        }

        if($request->has('coef') && $request->coef)
        {
            $arm_agahies->where('coef' , 'like' , "%$request->coef%");
        }
        if($request->has('from_date') && $request->from_date)
        {
            $from_date = explode ('/' , $request->from_date);
            $from_date = Verta::getGregorian($from_date[0] , $from_date[1] , $from_date[2]);
            $from_date = implode('-' , $from_date);

            $arm_agahies->where('from_date' , '>=' , $from_date);
        }
        
        if($request->has('to_date') && $request->to_date)
        {
            $to_date = explode('/' , $request->to_date);
            $to_date = Verta::getGregorian($to_date[0] , $to_date[1] , $to_date[2]);
            $to_date = implode('-' , $to_date);

            $arm_agahies->where('to_date' , '<=' , $to_date);
        }
        if($request->has('user_id') && $request->user_id)
        {
            $arm_agahies->where('user_id' , $request->user_id);
        }
        $arm_agahies = $arm_agahies->get();
        return view('arm_agahi.index' , ['arm_agahies' => $arm_agahies , 'channels' => $channels , 'users' => $users]);
    }

}
