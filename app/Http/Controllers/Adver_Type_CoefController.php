<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adver_Type_Coef;
use App\Adver_Type;
use App\User;
use Illuminate\Support\Facades\Gate;
use Hekmatinasser\Verta\Verta;

class Adver_Type_CoefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Adver_Type_Coef'))return abort(403,'عدم دسترسی');
        {
            $adver_type_coefs = Adver_Type_Coef::all();
            $adver_types = Adver_Type::all();
            $users = User::all();
            // dd($adver_type_coefs);
            return view('adver_type_coef.index' , ['adver_type_coefs' => $adver_type_coefs , 'adver_types' => $adver_types , 'users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        // dd('new');
        $users = User::all();
        $adver_types = Adver_Type::all();
        if($id == null && Gate::allows('Insert_Adver_Type_Coef'))
        {
            $adver_type_coef = (object)[];
            $status = 'insert';
        }
        elseif($id != null && Gate::allows('Edit_Adver_Type_Coef'))
        {
            $adver_type_coef = Adver_Type_Coef::findOrFail($id);
            $status = 'update';
            // dd($adver_type_coef);
        }
        else
        {
            return abort(403,'عدم دسترسی');
        }
        return response()->json($adver_type_coef);

        // return view('adver_type_coef.create' , ['adver_type_coef' => $adver_type_coef , 'status' => $status , 'users' => $users , 'adver_types' => $adver_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        // dd('edit');

        $request->validate([
            'adver_type_id' => 'required' ,
            'coef' => 'required|min:1|max:3|gt:0|between:1,200' , // |numeric
            'from_date' => 'required' ,  // |date
            'to_date' => 'required'  // |date 
        ]);

        if($id == null && Gate::allows('Insert_Adver_Type_Coef'))
        {
            $adver_type_coef = new Adver_Type_Coef();
        }
        elseif($id != null && Gate::allows('Edit_Adver_Type_Coef'))
        {
            $adver_type_coef = Adver_Type_Coef::findOrFail($id);
        }
        else
        {
            return abort(403 , 'عدم دسترسی');
        }
        // dd($adver_type_coef);

        $adver_type_coef->adver_type_id = $request->adver_type_id;
        $adver_type_coef->coef = $request->coef;
        $adver_type_coef->from_date = $request->from_date;
        $adver_type_coef->to_date = $request->to_date;

        // dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
        $adver_type_coef->user_id = $request->user_id;

        $adver_type_coef->save();
        // return redirect()->route('adver_type_coef.index');
        return redirect()->back()->with('message' , 'Save Successful');
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
        if(!Gate::allows('Delete_Adver_Type_Coef'))return abort(403,'عدم دسترسی');
        {
            // امکان حذف نداشته باشد به هیچ عنوان فقط ادمین بتواند
            // ادمین هم درصورتیکه با ضریب، کدآگهی یا جدول وابسته به آن ثبت نشده باشد، میتواند ثبت کند
            $adver_type_coef = Adver_Type_Coef::destroy($id);
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $adver_types = Adver_Type::all();
        $users = User::all();
        $adver_type_coefs = Adver_Type_Coef::query();

        if($request->has('adver_type_id') && $request->adver_type_id)
        {
            $adver_type_coefs->where('adver_type_id' , $request->adver_type_id);
        }

        if($request->has('coef') && $request->coef)
        {
            $adver_type_coefs->where('coef' , 'like' , "%$request->coef%");
        }
        
        if($request->has('from_date') && $request->from_date)
        {
            $from_date = explode ('/' , $request->from_date);
            $from_date = Verta::getGregorian($from_date[0] , $from_date[1] , $from_date[2]);
            $from_date = implode('-' , $from_date);

             $adver_type_coefs->where('from_date' , '>=' , $from_date);
            // $adver_type_coefs->whereBetween($from_date , ['from_date' , 'to_date']);
        }
        
        if($request->has('to_date') && $request->to_date)
        {
            $to_date = explode('/' , $request->to_date);
            $to_date = Verta::getGregorian($to_date[0] , $to_date[1] , $to_date[2]);
            $to_date = implode('-' , $to_date);

            $adver_type_coefs->where('to_date' , '<=' , $to_date);
            // $adver_type_coefs->whereBetween($to_date , ['from_date' , 'to_date']);
        }

        if($request->has('user_id') && $request->user_id)
        {
            $adver_type_coefs->where('user_id' , $request->user_id);
        }

        $adver_type_coefs = $adver_type_coefs->get();
        return view('adver_type_coef.index' , ['adver_type_coefs' => $adver_type_coefs , 'adver_types' => $adver_types , 'users' => $users]);
    }

}


// $dt = Carbon::now();
// $getmonths= DB::table('Financial_Year')
//                    ->whereBetween($dt, ['start_date', 'End_date'])->get();
