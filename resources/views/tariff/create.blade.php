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

    <a href="{{route('tariff.index')}}" class="previous">لیست تعرفه &raquo;</a>
    <br>

    <form action="@if ($status == 'insert') {{route('tariff.store')}} @else {{route('tariff' , $tariff->id)}} @endif" method ="post">
        @csrf
        @if($status == 'update')@method('put') @endif 
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="form-group" style="width:250px; "> <!-- margin-right:50px;  -->
                        <select name="channel_id" id="myselect" multiple class="form-control">
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}" @if($status == 'update') @if($channel->id == $tariff->channel_id) selected @endif @endif>{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group" style="width:200px;">
                        <select name="classes_id" id="myselect-2" multiple class="form-control">
                            @foreach($classes as $classe)
                                <option value="{{$classe->id}}" @if($status == 'update') @if($classe->id == $tariff->classes_id) selected @endif @endif>{{$classe->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="from_date" placeholder="از تاریخ" class="form-control" @if($status == 'update') value="{{$tariff->from_date}}" @endif style="width:150px;">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control" @if($status == 'update') value="{{$tariff->to_date}}" @endif style="width:150px;">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group" style="width:250px;">
                        <select name="box_type_id" id="myselect-3" multiple class="form-control">
                            @foreach($box_types as $box_type)
                                <option value="{{$box_type->id}}" @if($status == 'update') @if($box_type->id == $tariff->box_type_id) selected @endif @endif>{{$box_type->box_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="number" id="priceSep" class="form-control" name="price" placeholder="مبلغ تعرفه" @if($status == 'update') value="{{$tariff->price}}" @endif style="width:250px;"> 
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <select name="user_id" id="myselect-4" multiple style="width:200px;">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $tariff->user_id) selected @endif @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary" style="border-radious:5px;">ثبت</button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <script>
        jQuery(function($){
            $('#priceSep').priceFormat({
                centsSeparator: ','
            });
        });
    </script>


@endsection

