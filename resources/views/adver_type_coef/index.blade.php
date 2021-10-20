@extends('layouts.app')
@section('content')

    <a href="{{route('adver_type_coef.create')}}" class="next" style="margin-right:20px;">اضافه نمودن ضریب نوع کدآگهی</a>
    <br>
    <br>

    <form action="{{route('adver_type_coef_search')}}" mthod="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">جستجو</label>

        <div class="row" style="border:1px ridge lightblue; padding-right:1px; padding-top:15px; margin-right:20px; width:1350px;">
            <div class="col">
                <div class="form-group">
                    <select name="adver_type_id" id="myselect" multiple style="width:300px;">
                        @foreach($adver_types as $adver_type)
                            <option value="{{$adver_type->id}}">{{$adver_type->adver_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="text" name="coef" placeholder="ضریب عنوان کدآگهی" class="form-control" style="width:180px;">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input data-jdp name="from_date"  placeholder="از تاریخ" class="form-control" style="width:150px;">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control" style="width:150px;">
                </div>            
            </div>

            <div class="col">
                <div class="form-group">
                    <select name="user_id" id="myselect-2" multiple style="width:320px;">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="submit" value="جستجو" class="btn btn-primary">
                </div>
            </div>

        </div>
    </form>
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px;  background-color:darkgray; text-align:center;" >ردیف</th>
            <th style="width:50px; background-color:darkgray; text-align:center;" >نوع کدآگهی</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">ضریب نوع کداگهی</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">از تاریخ</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">تا تاریخ</th>
            <th style="width:50px; background-color:darkgray; ">Action</th>
        </tr>

        @foreach($adver_types as $adver_type)
            @foreach($adver_type_coefs as $adver_type_coef)
                @if( $adver_type->id == $adver_type_coef->adver_type_id )
                    <tr class="rowt" style="height:1px;">
                        <td class="rowtt" style="height:1px; text-align:center;"></td>
                        <td style="height:1px;">{{$adver_type->adver_type}}</td>
                        <td style="height:1px; width:10px;">{{$adver_type_coef->coef}}</td>
                        <td style="height:1px;width:10px;">{{$adver_type_coef->from_date}}</td>
                        <td style="height:1px;width:10px;">{{$adver_type_coef->to_date}}</td>
                        <td class="btn-group">
                            @can('Edit_Adver_Type_Coef')
                                <a href="{{route('adver_type_coef.edit' , $adver_type_coef->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @can('Delete_Adver_Type_Coef')
                                <form action="{{route('adver_type_coef.destroy' , $adver_type_coef->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>

@endsection


