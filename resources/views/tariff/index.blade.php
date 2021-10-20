@extends('layouts.app')
@section('content')

    <a href="{{route('tariff.create')}}" class="next">اضافه نمودن تعرفه</a>
    <br>
    <br>

    <form action="{{route('tariff_search')}}" method="get">
        <label>جستجو</label>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select name="channel_id" id="myselect" multiselect>
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    </select>
                </div>
            </div>
        </div>

    </form>























@endsection