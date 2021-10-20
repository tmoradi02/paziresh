@extends('layouts.app')
@section('content')

    <a href="{{route('product.create')}}" class="next">اضافه نمودن محصولات</a>
    <br>
    <br>

    <form action="{{route('product_search')}}" method="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">جستجو</label>
        <div style="border:1px ridge lightblue; padding-right:10px; margin-right:20px; padding-top:10px; margin-left:600px; height:60px;">
            <div class="row">

                <!-- <div class="col">   Select Mamoolo
                    <div class="form-group">
                        <select name="cast_id" class="form-control js-example-basic-single">
                        <option value="">انتخاب صنف</option>
                            @foreach($casts as $cast)
                                <option value="{{$cast->id}}">{{$cast->cast}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> -->

                <div class="col">
                    <div class="form-group">
                        <select name="cast_id" id="myselect" multiple>
                            @foreach($casts as $cast)
                                <option value="{{$cast->id}}">{{$cast->cast}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="width:300px;">
                        <input type="text" name="product" placeholder="جستجو عنوان محصول" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="width:300px;">
                        <select name="user_id" id="myselect-2" multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </form>

    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center">ردیف</th>
            <th style="width:400px; background-color:darkgray; text-align:center;">عنوان صنف</th>
            <th style="width:600px; background-color:darkgray; text-align:cenetr;">عنوان محصول</th>
            <th style="width:300px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($casts as $cast)
            @foreach($products as $product)
                @if($cast->id == $product->cast_id)
                    <tr class="rowt" style="height:1px;">
                        <td class="rowtt" style="height:1px; text-align:center;"></td>
                        <td style="height:1px;">{{$cast->cast}}</td>
                        <td style="height:1px;">{{$product->product}}</td>
                        <td class="btn-group" style="height:1px;">
                            @can('Edit_Product')
                                <a href="{{route('product.edit' , $product->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @can('Delete_Product')
                                <form action="{{route('product.destroy' , $product->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>
@endsection

