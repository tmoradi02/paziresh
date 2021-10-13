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

    <a href="{{route('adver_type.index')}}" class="previous">لیست نوع کدآگهی</a> 
    <br>
    
    <form action="@if($status == 'insert') {{route('adver_type.store')}} @else {{route('adver_type',$adver_type->id)}} @endif" method="post">
        @csrf
        @if($status == 'update') @method('put') @endif
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="adver_type" placeholder="نوع کدآگهی" maxlength = "50" class="form-control" @if($status == 'update') value = "{{$adver_type->adver_type}}" @endif>
                    </div>
                </div> 

                <div class="col">
                    <select name="user_id" id="myselect" multiple style="width:200px;">
                        @can('Get_Permission_To_Other_User')
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $adver_type->user_id) selected @endif @endif>{{$user->name}}</option>
                            @endforeach
                        @endcan
                    </select>
                </div> 

                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary">ثبت</button>
                    </div>
                </div> 
            </div>
        </div>
    </form>
@endsection


