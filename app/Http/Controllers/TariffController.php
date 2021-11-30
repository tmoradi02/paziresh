<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tariff;
use App\User;
use App\Channel;
use App\Classes;
use App\Box_Type;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Tariff')) return abort(403,'عدم دسترسی');
        {
            $users = User::all();
            $channels = Channel::all();
            $classes = Classes::all();
            $box_types = Box_Type::all();
            $tariffs = Tariff::all();

            return view('tariff.index' , ['tariffs' => $tariffs , 'channels' => $channels , 'classes' => $classes , 'users' => $users , 'box_types' => $box_types]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $channels = Channel::all();
        $users = User::all();
        $classes = Classes::all();
        $box_types = Box_Type::all();
        if($id == null & Gate::allows('Insert_Tariff'))
        {
            $tariff = (object)[];
            $status = 'insert';
        }
        elseif($id != null & Gate::allows('Edit_Tariff'))
        {
            $tariff = Tariff::findOrFail($id);
            // dd($tariff->price);
            $status = 'update';
        }
        else
        {
            return abort(403 , 'عدم دسترسی');
        }

        return response()->json($tariff);
        // return view('tariff.create' , ['tariff' => $tariff , 'status' => $status , 'channels' => $channels , 'classes' => $classes , 'box_types' => $box_types , 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        // کنترل کردن ثبت شبکه های تی وی یا رادیو با نوع انها در زمان ثبت 
        // حتما انجام شود 
        // در حال حاضر کنترل نمی شود

        // dd($request->all());

        $request->validate([
            
            'channel_id' => 'required' , 
            'classes_id' => 'required' , 
            'box_type_id' => 'required' , 
            'from_date' => 'required' , 
            'to_date' => 'required' , 
            'price' => 'required|min:6' 
        ]);

        

        if($id == null && Gate::allows('Insert_Tariff'))
        {
            $tariff = new Tariff();
        }
        elseif($id != null && Gate::allows('Edit_Tariff'))
        {
            $tariff = Tariff::findOrFail($id);
        }
        else
        {
            return abort(403 , 'عدم دسترسی');
        }
        
        // dd($request->all());

        // if(!Gate::allows('Insert_ArmAgahi')) return abort(403,'عدم دسترسی');
        // {
        //     $arm_agahi = new ArmAgahi(); 
        //     $arm_agahi->channel_id = $request->channel_id; 
        //     if(trim($request->coef) <> 0 ) $arm_agahi->coef = trim($request->coef); 
        //     // dd(str_replace("/" , "-" , $request->from_date)); 
        //     $arm_agahi->from_date =  $request->from_date; // str_replace("/" , "-" , $request->from_date); // "1400/07/01";  //$request->from_date;
        //     // dd($request->to_date); 
        //     $arm_agahi->to_date = $request->to_date; // str_replace("/" , "-" , $request->to_date); // "1400/07/30";  //$request->to_date;
        //     $arm_agahi->user_id = $request->user_id; 
        //     // dd($arm_agahi); 
        //     if($this->checkunqueu($arm_agahi)) 
        //     { 
        //         $arm_agahi->save(); 
        //         return redirect()->route('arm_agahi.index'); 
        //     } 
        //     return redirect()->route('arm_agahi.index')->with('warning','تکراری می باشد'); 
        // } 

        $tariff->channel_id = $request->channel_id;
        $tariff->classes_id = $request->classes_id;
        $tariff->box_type_id = $request->box_type_id;
        $tariff->from_date = $request->from_date;
        $tariff->to_date = $request->to_date;
        $tariff->price = $request->price;

        // dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
        $tariff->user_id = $request->user_id;

        // dd($request->all());

        $tariff->save();
        return redirect()->route('tariff.index');
    }

    public function checkunqueu($handler)
    {
        $from_date = jalaliToGergia($handler->from_date);
        $to_date = jalaliToGergia($handler->to_date);

        $query = Tariff::
            Where('classes_id' , '=' , $handler->classes_id) 
            ->whereDate('from_date' , '<=' , jalaliToGergia($handler->from_date))
            ->OrwhereDate('to_date' , '>=' , jalaliToGergia($handler->from_date))

            ->OrwhereDate('from_date' , '<=' , jalaliToGergia($handler->to_date))
            ->whereDate('to_date' , '>=' , jalaliToGergia($handler->to_date))

            ->first();

            if($query)return false;
            return true;
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
        if(!Gate::allows('Delete_Tariff')) return abort(403 , 'عدم دسترسی');
        {
            $tariff = Tariff::destroy($id);
            return redirect()->back();
        }
    }
}

