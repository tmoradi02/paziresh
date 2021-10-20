@extends('layouts.app')
@section('content')

    <a href="{{route('classes.create')}}" class="next">اضافه نمودن طبقه</a>
    <br>
    <br>
    
    <form action="{{route('classes_search')}}" method="get">
        <label style="margin-right:30px; font-weight:bold; color:gray;">جستجو</label>
        <div style="margin-right:30px;">
            <div class="row" style="border:1px ridge lightblue;width:430px;padding:15px 0px; height:70px;">

                <div class="col" >
                    <div class="form-group" style="width:300px;">
                        <input type="text" name="class_name" placeholder="جستجو عنوان طبقه" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </form>

    <br>

    <table class="table table-bordered" style="margin-right:20px; margin-left: 30px;">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">عنوان طبقه</th>
            <th style="width:300px; background-color:darkgray; ">action</th>
        </tr>
        @foreach($classes as $classe)
            <tr class="rowt" style="height: 1px;">
                <td class="rowtt" style="height: 1px; text-align:center;"></td>
                <td class="height:1px;">{{$classe->class_name}}</td>
                <td class="btn-group" style="height: 1px;">
                    @can('Edit_Classes')
                        <a href="{{route('classes.edit', $classe->id )}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Classes')
                        <form action="{{route('classes.destroy' , $classe->id)}}" method="post">
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


