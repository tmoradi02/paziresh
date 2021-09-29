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

    <form action="{{route('arm_agahi.store')}}" method="post">
        @csrf
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <select name="channel_id" id="myselect" multiple style="width:200px;">
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}">{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="number" step="any" name="coef" placeholder="ضریب آرم آگهی" class="form-control" >
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="from_date" placeholder="از تاریخ" class="form-control" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control"/>
                    </div>
                </div>

                <div class="col">
                    @can('Get_Permission_To_Other_User')
                        <select name="user_id" id="myselect-2" multiple style="width:200px;">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    @endcan
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="ثبت" class="btn btn-primary">    
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

