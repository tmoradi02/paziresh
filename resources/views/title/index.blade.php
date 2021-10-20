@extends('layouts.app')
@section('content')

    <a href="{{route('title.create')}}" class="next">اضافه نمودن عنوان باکس</a>
    <br>
    <br>
    
    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">عنوان باکس</th>
            <th style="width:200px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($titles as $title)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$title->title}}</td>
                <td class="btn-group">
                    @can('Edit_Title')
                        <a href="{{route('title.edit' , $title->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Title')
                    <form action="{{route('title.destroy' , $title->id)}}" method="post">
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
