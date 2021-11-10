<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cast;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('Visit_Product')) return abort(403,'عدم دسترسی');
        {
            $products = Product::all();
            $casts = Cast::all();
            $users = User::all();
            return view('product.index' , ['products'=> $products , 'casts' => $casts, 'users' => $users ]);;
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
        $casts = Cast::all();
        if($id == null && Gate::allows('Insert_Product'))
        {
            // dd($id);
            $status = 'insert';
            $product = (object)[];
        }
        elseif($id != null && Gate::allows('Edit_Product'))
        {
            $status = 'update';
            $product = Product::findOrFail($id);
        }
        else{
            return abort(403,'عدم دسترسی');
        }
        return response()->json($product);

        // return view('product.create',['product'=>$product , 'users' => $users , 'status' => $status,'casts'=> $casts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id = null)
    {
        $request->validate([
            'product' => 'required|min:3' ,
        ]);
            
        if($id == null && Gate::allows('Insert_Product'))
        {
            $product = new Product();
        }
        elseif($id != null && Gate::allows('Edit_Product'))
        {   
            $product = Product::findOrFail($id);
        }
        else
        {
            return abort(403,'عدم دسترسی');
        }

        $product->product = trim($request->product); 
        $product->cast_id = $request->cast_id; 
        $product->user_id = $request->user_id; 
        $product->save(); 
        // dd($request->all()); 
        // dd($product->all()); 

        return redirect()->back()->with('message' , 'OK'); 
        // return redirect()->route('product.index');
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
        if(!Gate::allows('Delete_Product'))return abort(403,'عدم دسترسی');
        {
            $product = Product::destroy($id);
            return redirect()->back();
        }
    }

    public function search(Request $request)
    {
        $casts = Cast::all();
        $users = User::all();
        $products = Product::query();

        if($request->has('cast_id') && $request->cast_id)
        {
            $products->where('cast_id' , $request->cast_id);
        }

        if($request->has('product') && $request->product)
        {
            $products->where('product' , 'like' , "%$request->product%");
        }

        if($request->has('user_id') & $request->user_id)
        {
            $products->where('user_id' , $request->user_id);
        }

        $products = $products->get();
        return view('product.index' , ['products' => $products , 'casts' => $casts , 'users' => $users]);
    }

}


