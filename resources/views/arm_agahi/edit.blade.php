@extends('layouts.app')
@section('content')

    <form action="{{route('arm_agahi.update', $arm_agahi->id)}}" method="post">
        @csrf
        @method('put')
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select name="channel_id" class="form-control" style="width:300px;">
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}" @if($arm_agahi->channel_id == $channel->id) selected @endif>{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="number" step="any" name="coef" placeholder="ضریب آرم آگهی" value="{{$arm_agahi->coef}}" class="form-control" style="width:150px;">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <!-- <label >از تاریخ</label> -->
                        <input data-jdp name="from_date" placeholder="از تاریخ" id="" value="{{$arm_agahi->from_date}}"  class="form-control" style="width:150px;" />
                            
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <!-- <label >تا تاریخ</label> -->
                        <input data-jdp name="to_date" placeholder="تا تاریخ" id="" value="{{$arm_agahi->to_date}}" class="form-control" style="width:150px;"/>
                        
                    </div>
                </div>
            <!-- </div> -->
            <!-- <div class="row"> -->
                <div class="col">
                    @can('Get_Permission_To_Other_User')
                        <select name="user_id" class="form-control" style="width:300px;">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($arm_agahi->user_id == $user->id) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    @endcan
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary" >
                    </div>
                </div>
                <!-- <div class="col"></div>
                <div class="col"></div> -->
            </div>
        </div>
    </form>
@endsection



