@extends('layouts.app')
@section('content')

    <a href="{{route('box_prog_group.create')}}" class="next">اضافه نمودن گروه برنامه</a>
    <br>
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:lightblue; text-align:center;">ردیف</th>
            <th style="width:400px; background-color:lightblue; text-align:center;">عنوان برنامه</th>
            <th style="width:300px; background-color:lightblue;"> Action</th>
        </tr>
        @foreach($box_prog_groups as $box_prog_group)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$box_prog_group->prog_group}}</td>
                <td class="btn-group" style="height:1px;">
                    @can('Edit_Box_Prog_Group')
                        <a href="{{route('box_prog_group.edit' , $box_prog_group->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Prog_Group')
                        <form action="{{route('box_prog_group.destroy' , $box_prog_group->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <form action="{{route('box_prog_group_search')}}" method="get">
        <!-- <div class="container"> -->
        <label style="padding:15px; font-weight:bold; color:gray; margin-right:20px;">جستجو</label>
        <div style="margin-right:10px;">
            <div class="row" style="border:1px ridge lightblue; width:700px; margin-right:15px; height:75px; padding:15px;">
                <div class="col">
                    <div class="form-group" style="width:545px;">
                        <input type="text" name="prog_group" placeholder="جستجو عنوان برنامه" class="form-control">
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