@extends('layouts.app')
@section('content')

    @if($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('classes.update', $classe->id)}}" method="post">
        @csrf
        @method('put')
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <input type="text" name="class_name" maxlength="10" placeholder="عنوان طبقه" class="form-control" value="{{$classe->class_name}}">
                    </div>
                </div>

                <div class="col">
                    @can('Get_Permission_To_Other_User')
                    <select name="user_id" id="myselect" multiple>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($user->id == $classe->user_id) selected @endif >{{$user->name}}</option>
                        @endforeach
                    </select>
                    @endcan
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection