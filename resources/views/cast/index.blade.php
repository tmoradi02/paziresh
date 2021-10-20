@extends('layouts.app')
@section('content')

    <a href="{{route('cast.create')}}" class="next">اضافه نمودن اصناف</a>
    <br>
    <br>
    
    <form action="{{route('cast_search')}}" method="get">
        <label style="margin-right:30px; font-weight:bold; color:gray;">جستجو</label>
        <div style="margin-right:30px;">
            <div class="row" style="border:1px ridge lightblue; width:600px; padding:15px 0px; height:70px;" >
                <div class="col">
                    <div class="form-group" style="width:470px;">
                        <input type="text" name="cast" placeholder="جستجو عنوان صنف" class="form-control">
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
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">عنوان صنف</th>
            <th style="width:300px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($casts as $cast)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$cast->cast}}</td>
                <td class="btn-group" style="height:1px;">
                    @can('Edit_Cast')
                    <a href="{{route('cast.edit' , $cast->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Cast')
                        <form action="{{route('cast.destroy' , $cast->id)}}" method="post">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger"><i class="fa fa-trash-alt" ></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection



