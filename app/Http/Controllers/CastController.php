<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cast;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Cast')) return abort(403,'عدم دسترسی');
        {
            $casts = Cast::all();
            $users = User::all();
            return view('cast.index',['casts' => $casts , 'users' => $users]);
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
        
        if($id !=null && Gate::allows('Edit_Cast'))
        {
            $cast = Cast::findOrFail($id);
            $status = 'update';
        }
        elseif($id == null && Gate::allows('Insert_Cast'))
        {
            // dd($id);
            $cast = (object)[];
            $status = 'insert';
            // return view('cast.create',['users' => $users]);
        }
        else{
            return abort(403,'عدم دسترسی');
        }
        return response()->json( $cast);
        // return view('cast.create' , ['cast' => $cast , 'users' => $users , 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        // dd($request->all());
        if($id == null && Gate::allows('Insert_Cast'))
        {
            $request->validate([
                'cast' => 'required|unique:casts',
            ]);
            $cast = new Cast();
        }
        elseif($id != null && Gate::allows('Edit_Cast'))
        {
            $cast = Cast::findOrFail($id);
            $request->validate([
                'cast' => [
                    'required',
                    'min:3' ,
                    Rule::unique('casts')->ignore($cast->id),
                ] ,
            ]);
        }
        else{
            return abort(403,'شما دسترسی ندارید!');
        }
        $cast->cast = trim($request->cast);

        // ST DOC 1400-09-21 با هر کاربر که لاگین کنیم با آیدی همان کاربر ثبت میکند
        $cast->user_id = auth()->user()->id; //$request->user_id;
        // $cast->user_id = $request->user()->id;  هر دو یکی هستند
        
        $cast->save();

        return redirect()->back()->with('message' , 'OK');
        // return redirect()->route('cast.index');
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
        if(!Gate::allows('Delete_Cast')) return abort(403,'عدم دسترسی');
        {
            // ST LOCK 1400-07-11  این قسمت بدلیل چک نکردن رکوردهای وابسته لاک گرفت شد
                // $cast = Cast::findOrFail($id);
                // $cast->product()->delete();
                // $cast->delete();
                // return redirect()->back(); 
            // END  LOCK 1400-07-11  این قسمت بدلیل چک نکردن رکوردهای وابسته لاک گرفت شد

            // ST DOC 1400-07-11  چک کردن رکوردهای وابسته به این جدول قبل از حذف رکورد
            $cast = Cast::findOrFail($id);

            $product = Product::where('cast_id' , '=' , $id)->first();
            if($product <> null)
            {
                return abort(403 , 'با صنف مورد نظر محصولاتی ثبت شده، امکان حذف این صنف نمی باشد');
            }
            elseif($product == null)
            {
                //  OR  $cast->delete();
                $cast = Cast::destroy($id);
            }
            return redirect()->back();
            // END DOC 1400-07-11  چک کردن رکوردهای وابسته به این جدول قبل از حذف رکورد
        }
    }

    public function search(Request $request)
    {
        $casts = Cast::query();
        if($request->has('cast') && $request->cast)
        {
            $casts->where('cast' , 'like' , "%$request->cast%");
        }
        $casts = $casts->get();
        return view('cast.index',['casts' => $casts]);
    }

}






