@extends('layouts.app')
@section('content')

    <a href="{{route('box_type.create')}}" class="next">اضافه نمودن محل پخش</a>
    <br>
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">نوع باکس</th>
            <th style="width:200px; background-color:darkgray; ">Action</th>
        </tr>

        @foreach($box_types as $box_type)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$box_type->box_type}}</td>
                <td class="btn-group">
                    @can('Edit_Box_Type')
                        <a href="{{route('box_type.edit' , $box_type->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Type')
                        <form action="{{route('box_type.destroy' , $box_type->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

@endsection



