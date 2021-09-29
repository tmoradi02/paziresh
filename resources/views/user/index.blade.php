@extends('layouts.app')
@section('content')

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:10px; background-color:lightblue; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:lightblue; text-align:center;">نام کاربر</th>
            <th style="width:350px; background-color:lightblue; text-align:center;">ایمیل</th>
            <th style="width:200px; background-color:lightblue; text-align:center;">تلفن</th>
            <th style="width:150px; background-color:lightblue; text-align:center;">وضعیت</th>
            <!-- <th style="width:150px; background-color:lightblue; text-align:center;">کلمه عبور</th> -->
        </tr>

        @foreach($users as $user)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$user->name}}</td>
                <td style="height:1px;">{{$user->email}}</td>
                <td style="height:1px;">{{$user->tell}}</td>
                @if($user->status == 1)
                    <td style="height:1px;">فعال</td>
                @elseif($user->status == 0)
                    <td style="height:1px;">غیر فعال</td>
                @endif
                <!-- <td style="height:1px;">{{$user->password}}</td> -->
                <td class="btn-group">
                    @can('Edit_User')
                        <a href="{{route('user.edit' , $user->id)}}" class="btn btn-warning"><i class="fa fa-pencil-alt"></i></a>
                    @endcan
                    
                    @can('Delete_User')
                        <form action="{{route('user.destroy' , $user->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <form action="{{route('user_search')}}" method="get">
        <label style="margin-right:15px; padding-right:15px; font-weight:bold; color:gray; ">جستجو</label>
        <div class="row" style="border:1px ridge lightblue; margin-right:15px; padding-top:15px; width:1600px;">

            <div class="col">
                <div class="form-group" style="padding-right: 10px;">
                    <input type="text" name="name" placeholder="نام کاربر" class="form-control" style="width:300px; ">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="text" name="email" placeholder="ایمیل" class="form-control" style="width:300px;">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="tel" name="tell" placeholder="تلفن" class="form-control" style="width:250px;">
                </div>
            </div> 

            <div class="col">
                <div class="form-group">
                    <input type="radio" name="status" id="1" value="1">
                    <label>فعال</label>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="radio" name="status" id="0" value="0">
                    <label>غیر فعال</label>
                </div>
            </div>

            <div class="col" style="background-color:lightblue;">
                <div class="form-group" style="width:300px;">
                    <select name="permission_id" id="myselect" multiple>
                        @foreach($permissions as $permission)
                            <option value="{{$permission->id}}">{{$permission->permission_name}}</option>
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
@endsection

