@extends('layouts.app')
@section('content')

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:lightblue; text-align:center;">ردیف</th>
            <th style="width:500px; background-color:lightblue; text-align:center;">عنوان صنف</th>
            <th style="width:300px; background-color:lightblue; ">Action</th>
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

    <form action="{{route('cast_search')}}" method="get">
        <!-- <div class="container"> -->
            <label style="margin-right:30px; font-weight:bold; color:gray;">جستجو</label>
            <div style="margin-left:900px; margin-right:30px;">
                <div class="row" style="border:1px ridge lightblue; widht:600px; height:70px; padding:15px;">
                    <div class="col">
                        <div class="form-group" style="width:420px;">
                            <input type="text" name="cast" placeholder="جستجو نام صنف" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </form>

@endsection



