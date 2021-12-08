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
            'channel_id' => 'required',
            'coef' => 'required|min:1|max:3|gt:0|between:1,200' , // |numeric
            'from_date' => 'required',  // |date
            'to_date' => 'required'  // |date 
        ]);

        if(!Gate::allows('Insert_ArmAgahi')) return abort(403,'عدم دسترسی');
        {
            $arm_agahi = new ArmAgahi(); 
            $arm_agahi->channel_id = $request->channel_id; 
            if(trim($request->coef) <> 0 ) $arm_agahi->coef = trim($request->coef); 
            $request->arm_agahi = $request->coef;

            $arm_agahi->from_date =  $request->from_date; // str_replace("/" , "-" , $request->from_date); // "1400/07/01";  //$request->from_date;
            $arm_agahi->to_date = $request->to_date; // str_replace("/" , "-" , $request->to_date); // "1400/07/30";  //$request->to_date;

            // dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
            $arm_agahi->user_id = $request->user_id; 

            // if($this->checkunqueu($arm_agahi)) // زمان ویرایش هم باید چک شود
            // { 
            //     $arm_agahi->save(); 
            //     return redirect()->route('arm_agahi.index'); 
            // } 

            $arm_agahi->save(); 
            return redirect()->back()->with('message' , 'ثبت با موفقیت انجام شد');
            // return redirect()->route('arm_agahi.index')->with('warning','تکراری می باشد'); 
        } 
    } 

    public function checkunqueu($handler)
    {
        // هر تاریخی وارد شود پیغام تکراری می دهد
        $from_date = jalaliToGergia($handler->from_date);
        $to_date = jalaliToGergia($handler->to_date) ;

        $query = ArmAgahi::
        where('channel_id' , '=' , $handler->channel_id)

        ->whereDate('from_date','<=', jalaliToGergia($handler->from_date))
        ->OrwhereDate('to_date','>=', jalaliToGergia($handler->from_date))

        ->OrwhereDate('from_date','<=', jalaliToGergia($handler->to_date))
        ->whereDate('to_date','>=', jalaliToGergia($handler->to_date))

        ->first();

        dd($query);

        if($query) return false;
        return true;

// ST Where With function 
        // where('channel_id', '=' , $handler->channel_id)
        // ->where(function ($q) {
        //     return $q->whereDate('from_date','<=', jalaliToGergia($handler->from_date))
        //     ->OrwhereDate('to_date','>=', jalaliToGergia($handler->from_date));
        // });

        // ->where(function ($qu) {
        //     return $qu->where('to_date','>=', jalaliToGergia($handler->to_date))
        //     ->Orwhere('from_date','<=', jalaliToGergia($handler->to_date));
        // })->first();
 
// END Where with function 

        //      مثال واقعی 
        // $from_date = 1400-05-01    $to_date = 1400-11-30 
        // (from_date <= '1400-03-01' AND to_date >= '1400-03-01' OR from_date <= '1400-11-30' AND to_date >= '1400-11-30')   
        // (1400-12-29 <= '1400-05-01' >= 1400-04-01 OR 1400-12-29 <= '1400-11-30' >= 1400-04-01)  
        //      مثال واقعی 


        // ->whereBetween($from_date , ['from_date' , 'to_date' ] )
        // ->whereBetween($to_date,['from_date' , 'to_date'  ] )
        

        // OS
    //     $query =  ArmAgahi::
    //     where('channel_id', '=', $handler->channel_id)
    //    ->where('from_date',  '>=' , jalaliToGergia($handler->from_date))
    //    ->where('to_date',  '<=' , jalaliToGergia($handler->to_date))
    //    ->first();
    //    if($query) return false;
    //    return true;
       // OS

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
            return response()->json($arm_agahi);
            // return response()->json('arm_agahi.edit', ['arm_agahi'=> $arm_agahi ,'channels'=> $channels , 'users' => $users]);
            // return view('arm_agahi.edit',['arm_agahi'=> $arm_agahi ,'channels'=> $channels , 'users' => $users ]);
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
            $arm_agahi->coef = $request->coef;
            $arm_agahi->from_date = $request->from_date;
            $arm_agahi->to_date = $request->to_date;
            $arm_agahi->user_id = $request->user_id;
            $arm_agahi->save();
            
            // dd($request->all());
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
