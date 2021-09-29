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

<form action="{{route('classes.store')}}" method="post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" name="class_name" maxlength="10" placeholder="عنوان طبقه" class="form-control">
                </div>
            </div>

            <div class="col">
                @can('Get_Permission_To_Other_User')
                    <select name="user_id" id="myselect" multiple>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                @endcan
            </div>

            <div class="col">
                <button class="btn btn-primary">ثبت</button>
            </div>
        </div>
    </div>
</form>


@endsection