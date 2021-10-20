@extends('layouts.app')
@section('content')

    <a href="{{route('owner.create')}}" class="next">اضافه نمودن صاحب آگهی</a>
    
    <br>
    <br>

    <form action="{{route('owner_search')}}" method="get">
        <label style="padding-right:20px;font-weight:bold;color:gray;">جستجو</label>
        <div style="border:1px ridge lightblue; margin-right:10px; padding-top:15px; padding-right:15px; padding-left:10px; margin-left:10px;">

            <div class="row" >

                <div class="col">
                    <div class="form-group" style="width:300px;">
                        <input type="text" name="owner" placeholder="جستجو نام صاحب آگهی" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" >
                        <input type="text" name="manager_owner" placeholder="نام مدیرعامل" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" >
                        <input type="text" name="email_owner" placeholder="ایمیل" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" >
                        <input type="text" name="tell_owner" placeholder="تلفن" class="form-control">
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group" >
                        <input type="text" name="fax_owner" placeholder="شماره فکس" class="form-control">
                    </div>
                </div>


                <div class="col">
                    <div class="form-group" >
                        <input type="text" name="address_owner" placeholder="آدرس" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="text" name="description_owner" placeholder="توضیحات" class="form-control">
                    </div>
                </div>
            </div>
            
            <div class="row">
            
                <div class="col">
                    <div class="form-group" style="flex-direction:row-reverse; margin-top:5px; margin-right:10px;">
                        <input type="radio" name="kind_group" id="1" value="1">
                        <label>گروه اول</label>
                    </div>
                </div>

                <div class="col" >
                    <div class="form-group" style="flex-direction:row-reverse; margin-top:5px;">
                        <input type="radio" name="kind_group" id="2" value="2">
                        <label>گروه دوم</label>                        
                    </div>
                </div>
                    
                <div class="col">
                    <div class="form-group" style="flex-direction:row-reverse; margin-top:5px;">
                        <input type="radio" name="kind_group" id="3" value="3">
                        <label>گروه سوم</label>                    
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
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                
            </div>
        </div>
    </form>
    
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:10px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">نام صاحب آگهی</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">نام مدیرعامل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">ایمیل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">تلفن</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">فکس</th>
            <th style="width:1100px; background-color:darkgray; text-align:center;">آدرس</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">گروه</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">توضیحات</th>
            <!-- <th style="width:200px; background-color:darkgray; text-align:center;">نام کاربر</th> -->
            <th style="width:200px; background-color:darkgray; text-align:center;">Action</th>
        </tr>

        @foreach($owners as $owner)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$owner->owner}}</td>
                <td style="height:1px;">{{$owner->manager_owner}}</td>
                <td style="height:1px;">{{$owner->email_owner}}</td>
                <td style="height:1px;">{{$owner->tell_owner}}</td>
                <td style="height:1px;">{{$owner->fax_owner}}</td>
                <td style="height:1px;">{{$owner->address_owner}}</td>
                @if($owner->kind_group == 1)
                    <td style="height:1px;">گروه اول</td>
                @elseif($owner->kind_group == 2)
                <td style="height:1px;">گروه دوم</td>
                @elseif($owner->kind_group == 3)
                    <td style="height:1px;">گروه سوم</td>
                @endif
                <td style="height:1px;">{{$owner->description_owner}}</td>
                <td class="btn-group">
                    @can('Edit_Owner')
                        <a href="{{route('owner.edit' , $owner->id)}}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                    @endcan

                    @can('Delete_Owner')
                        <form action="{{route('owner.destroy' , $owner->id)}}" method="post">
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

