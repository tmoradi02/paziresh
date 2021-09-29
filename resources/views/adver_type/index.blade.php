@extends('layouts.app')
@section('content')

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:lightblue; text-align:center;">ردیف</th>
            <th style="width:300px; background-color:lightblue; text-align:center;">نوع کدآگهی</th>
            <th style="width:300px; background-color:lightblue; ">Action</th>
        </tr>
        @foreach($adver_types as $adver_type)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$adver_type->adver_type}}</td>
                <td class="btn-group" style="height:1px;">
                    @can('Edit_Adver_Type')
                        <a href="{{route('adver_type.edit' , $adver_type->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Adver_Type')
                        <form action="{{route('adver_type.destroy', $adver_type->id)}} , $adver_type->id" method="post">  
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <form action="{{route('adver_type_search')}}" method="get">
        <label style="padding-right:40px; font-weight:bold; color:gray;" >جستجو</label>
        <!-- <div class="container"> -->
            <div style="padding-right:20px;">
            <div class="row" style="border:1px ridge lightblue; margin-right:10px; padding-top:15px; width:550px; padding-right:10px;r;">
    
                <div class="col">
                    <div class="form-group" style="width:400px;">
                        <input type="text" name="adver_type" placeholder="نوع کدآگهی" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
            </div>
        <!-- </div> -->
    </form>

@endsection