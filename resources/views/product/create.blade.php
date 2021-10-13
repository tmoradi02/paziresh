@extends('layouts.app')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{route('product.index')}}" class="previous">لیست محصولات</a>
    <br>
    
    <form action="@if($status =='insert') {{route('product.store')}} @else {{route('product',$product->id)}} @endif" method="post">
        @csrf
        @if($status == 'update') @method('put') @endif
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <select name="cast_id" id='myselect' multiple  placeholder="جستجو">
                            @foreach($casts as $cast)
                                <option value="{{$cast->id}}" @if($status == 'update') @if($cast->id == $product->cast_id) selected @endif @endif >{{$cast->cast}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- <div class="col">
                    <select name="cast_id" class="form-control">
                        @foreach($casts as $cast) 
                            <option value="{{$cast->id}}" @if($status == 'update') @if($cast->id == $product->cast_id) selected @endif @endif>{{$cast->cast}}</option>
                        @endforeach
                    </select>
                </div> -->

                <div class="col">
                    <div class="form-group">
                        <input type="text" name="product" maxlength="100" placeholder="عنوان محصول" class="form-control" @if($status == 'update') value="{{$product->product}}" @endif>
                    </div>
                </div>

                <!-- <div class="col">    For Select Mamooli   ST LOCK 1400-06-21
                    <div class="form-group">
                        @can('Get_Permission_To_Other_User')
                            <select name="user_id" class="form-control">
                                @foreach($users as $user) 
                                    <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $product->user_id) selected @endif @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        @endcan
                    </div>
                </div>   For Select Mamooli   ST LOCK 1400-06-21   -->       
                
                <div class="col">
                    <div class="form-group">
                        @can('Get_Permission_To_Other_User')
                            <select name="user_id" id='myselect-2' multiple >
                            @foreach($users as $user) 
                                    <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $product->user_id) selected @endif @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        @endcan
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary" style="border-radius:5px;">ثبت</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

