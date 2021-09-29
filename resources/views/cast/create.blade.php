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

    <form action="@if($status == 'insert') {{route('cast.store')}} @else {{route('cast', $cast->id)}} @endif" method="post">
        @csrf
        @if($status == 'update') @method('put') @endif
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="cast" placeholder="نام صنف" maxlength="80" class="form-control" @if($status == 'update') value="{{$cast->cast}}" @endif> 
                    </div>
                </div>
                
                <div class="col">
                    <select name="user_id" id="myselect" multiple >
                        @can('Get_Permission_To_Other_User')
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $cast->user_id) selected @endif @endif>{{$user->name}}</option>
                            @endforeach
                        @endcan
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary" style="border-radius: 5px;">ثبت</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

