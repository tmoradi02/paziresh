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

    <form action="@if($status == 'Insert'){{route('channel.store')}} @else {{route('channel',$channel->id)}} @endif" method="post">
        @csrf
        @if($status == 'Update') @method('put') @endif
        
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="channel_name" maxlength="50" placeholder="عنوان شبکه" class="form-control" @if($status == 'Update') value="{{$channel->channel_name}}" @endif>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="number" name="degree" placeholder="مشخصه شبکه" class="form-control" @if($status == 'Update') value="{{$channel->degree}}" @endif>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="radio" name="kind" id="1" value="1" @if($status == 'Update')  @if($channel->kind == 1) checked @endif @else($status == 'Insert') checked @endif>
                        <label>تلویزیونی</label>
                    </div>
                    <div class="form-group">
                        <input type="radio" name="kind" id="2" value="2" @if($status == 'Update')  @if($channel->kind == 2) checked @endif @endif>
                        <label >رادیویی</label>
                    </div>
                </div>
                <div class="col">
                    @can('Get_Permission_To_Other_User')
                        <select name="user_id" id="myselect" multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($status == 'Update') @if($user->id == $channel->user_id) selected @endif @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    @endcan
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary" >
                    </div>
                </div>
            </div>        
        </div>
    </form>

@endsection

