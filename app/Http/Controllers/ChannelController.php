<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\ArmAgahi;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Channel')) return abort(403,'عدم دسترسی');
        {
            $channels = Channel::all();
            $users = User::all();
            return view('channel.index',['channels'=> $channels , 'users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        // if ($id != null ) 
        // dd('method create');
        
        $users = User::all();
        if($id == null && Gate::allows('Insert_Channel')) // return abort(403,'عدم دسترسی'); // Create
        {
            $channel = (object)[];
            $status = 'Insert';
        } 
        elseif($id !== null && Gate::allows('Edit_Channel')) // return abort (403,'عدم دسترسی'); // Edit
        {
            $channel = Channel::findOrFail($id);
            $status = 'Update';
        }
        else{
            return abort (403,'عدم دسترسی');
        }
        // return view ('channel.create',['channel'=> $channel ,'users' => $users , 'status' => $status]);
        return response()->json($channel);

        // return response()->json(['channel' => $channel , 'users' => $users , 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        // dd('method store');
        // dd($request->all());

        if($id !== null && Gate::allows('Edit_Channel')) //return abort (403,'عدم دسترسی');
        {
            $channel = Channel::findOrFail($id); 
            $request->validate ([
                'channel_name' => [
                    'required', 
                    'min:3' , 
                    Rule::unique('channels')->ignore($channel->id),
                ],
                'degree' => [
                    'required' , 
                    Rule::unique('channels')->ignore($channel->id),
                ],
            ]);     
        }
        elseif($id == null && Gate::allows('Insert_Channel')) // return abort (403,'عدم دسترسی');
        {
            $request->validate([
                'channel_name' => 'required|unique:channels|min:3' ,
                'degree' => 'required|unique:channels|min:1|max:3',   // 
            ]);
            $channel = new Channel();
        }
        else{
            return abort (403,'عدم دسترسی');
        }
        // dd($request->all());

        $channel->channel_name = $request->channel_name;
        $channel->degree = $request->degree;
        $channel->kind = $request->kind;

        //$user_id = User::findOrFail($id);
        dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
        $channel->user_id = $request->user_id ;

        $channel->save();
        
        return redirect()->back()->with('message' , 'شبکه مورد نظر با موفقیت ثبت شد');
        // return redirect()->route('channel.index')->with('message' , 'شبکه مورد نظر با موفقیت ثبت شد');
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
        if(!Gate::allows('Delete_Channel')) return abort (403,'عدم دسترسی');
        {
            //  ST DOC 1400-07-10 نباید امکان حذف شبکه باشد فقط در صورتیکه ضرایب آرم آگهی و کنداکتور آن شبکه قبلش حذف شود

            // $channel = Channel::destroy($id);
            // return redirect()->back();

            $channel = Channel::findOrFail($id);

            $arm_id = ArmAgahi::where('channel_id' , '=' , $id)->first();
            if($arm_id <> null)
            {
                return abort(403,'با شبکه مورد نظر ضریب آرم آگهی ثبت شده است، امکان حذف این شبکه نمی باشد');
            }
            elseif($arm_id == null)
            {
                $channel = Channel::destroy($id);
                // Or  $channel->delete();
            }
            return redirect()->back();
        }
    }
}



