<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adver_Type;
use App\User;
use App\Adver_Type_Coef;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class Adver_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Adver_Type')) return abort(403,'عدم دسترسی');
        {
            $adver_types = Adver_Type::all();
            $users = User::all();
            return view('adver_type.index' , ['adver_types' => $adver_types , 'users' => $users]);
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
        if($id == null & Gate::allows('Insert_Adver_Type'))
        {
            $adver_type = (object)[];
            $status = 'insert';
        }
        elseif($id != null & Gate::allows('Edit_Adver_Type'))
        {
            $adver_type = Adver_Type::findOrFail($id);
            $status = 'update';
        }
        else
        {
            return abort(403 , 'عدم دسترسی');
        }

        return response()->json($adver_type);

        // return view('adver_type.create' , ['adver_type' => $adver_type , 'users' => $users , 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        // dd('fmnmn');
        if($id == null & Gate::allows('Insert_Adver_Type'))
        {
            $request->validate([
                'adver_type' => 'required|min:3|unique:adver_types',
            ]);

            $adver_type = new Adver_Type();
        }
        elseif($id != null & Gate::allows('Edit_Adver_Type'))
        {
            $adver_type = Adver_Type::findOrFail($id);
            // dd($adver_type);
            $request->validate([
                'adver_type' => [
                    'required' ,
                    'min:3' ,
                    Rule::unique('Adver_types')->ignore($adver_type->id),
                ],
            ]);
        }
        else
        {
            return abort(403,'عدم دسترسی');
        }

        $adver_type->adver_type = trim($request->adver_type) ;

        // dd('در صورتیکه کاربر غیر ادمین ثبت کند، باید با آیدی آن کاربر ثبت شود');
        $adver_type->user_id = $request->user_id;

        
        $adver_type->save();

        // dd($adver_type->all());

        return redirect()->back()->with('message' , 'ثبت با موفقیت انجام شد');

        // return redirect()->route('adver_type.index');
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
        if(!Gate::allows('Delete_Adver_Type')) return abort(403,'عدم دسترسی');
        {
            // ST DOC 1400-07-11 حذف نوع کدآگهی به شرط چک نمودن رکوردهای ضریب نوع کدآگهی
            $adver_type = Adver_Type::findOrFail($id);

            // ST DOC  در صورتیکه با صنف مورد نظر محصولی ثبت شده باشد، اجازه حذف نمی دهد
            $adver_type_coef_id = Adver_Type_Coef::where('adver_type_id' , '=' , $id)->first();

            if($adver_type_coef_id <> null)
            {
                return abort(403,'با صنف مورد نظر محصول ثبت شده است، امکان حذف ندارید');
                // $adver_type->adver_type_coef()->delete();
            }
            elseif($adver_type_coef_id == null)
            {
                $adver_type->delete();
            }
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $adver_types = Adver_Type::query();
        
        if($request->has('adver_type') && $request->adver_type)
        {
            $adver_types->where('adver_type' , 'like' , "%$request->adver_type%");
        }
        $adver_types = $adver_types->get();
        return view('adver_type.index' , ['adver_types' => $adver_types]);
    }
}


