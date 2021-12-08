@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام دادن به کاربر  -->
    @if($errors->any())
        <div class="alert-box">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام دادن به کاربر -->

    
    <a href="{{route('owner.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن صاحب آگهی</a>
    
    <br>
    <br>

    <form action="{{route('owner_search')}}" method="get">
        <label style=" padding-right:20px; font-weight:bold; color:gray;">جستجو</label>
        <div style=" border:1px ridge lightblue; margin-right:10px; padding-top:15px; padding-right:15px; padding-left:10px; margin-left:10px;">

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
            <th style="width:400px; background-color:darkgray; text-align:center;">نام مدیرعامل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">ایمیل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">تلفن</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">فکس</th>
            <th style="width:1100px; background-color:darkgray; text-align:center;">آدرس</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">گروه</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">توضیحات</th>
            @can('Get_Permission_To_Other_User')
                <th style="width:300px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
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
                
                @can('Get_Permission_To_Other_User')
                    @foreach($users as $user)
                        @if($user->id == $owner->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group">
                    @can('Edit_Owner')
                        <a href="{{route('owner.edit' , $owner->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#editModal"><i class="fa fa-pen"></i></a>
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

    <!-- ST DOC 1400-08-30 Modal Form For New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن صاحب آگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Modal Form -->
                    <form action="{{route('owner.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="owner" placeholder="عنوان صاحب آگهی" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="manager_owner" placeholder="نام مدیرعامل" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email_owner" placeholder="ایمیل" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="tell_owner" placeholder="تلفن" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group"> 
                                        <input type="text" name="fax_owner" placeholder="فکس" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="address_owner" placeholder="آدرس" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border:1px ridge lightblue; padding-top:15px; padding-left:5px; margin-right:1px; margin-left:1px; margin-bottom:15px;">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind_group" id="1" value="1" checked>
                                        <label>گروه اول</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group" style="flex-direction:row-reverse; ">
                                        <input type="radio" name="kind_group" id="2" value="2">
                                        <label>گروه دوم</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind_group" id="3" value="3"> 
                                        <label>گروه سوم</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="description_owner" placeholder="توضیحات" class="form-control">
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col">
                                    <select name="user_id" class="form-control show-user" >
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="ثبت" class="btn btn-primary" style="margin-top:10px;">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" style="margin-top:10px;" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END Modal Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-30 Modal Form For New Record --> 

    <!-- ST DOC 1400-09-01 Modal For Edit Form -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش صاحب آگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Modal Edit -->
                    <form action="" class="edit-owner" method="post">
                        @csrf
                        @method('put') 
                        
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="owner" id="owner" class="form-control" placeholder="عنوان صاحب آگهی">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="manager_owner" id="manager-owner" class="form-control" placeholder="نام مدیرعامل">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email_owner" id="email-owner" class="form-control" placeholder="ایمیل">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="tell_owner" id="tell-owner" class="form-control" placeholder="تلفن">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="fax_owner" id="fax-owner" class="form-control" placeholder="فکس">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="address_owner" id="address-owner" class="form-control" placeholder="آدرس">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border:1px ridge lightblue; margin-right:1px; margin-left:1px; margin-top:-1px; padding-top:15px;">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind_group" id="group-1" value = "1">
                                        <label>گروه اول</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind_group" id="group-2" value = "2">
                                        <label>گروه دوم</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind_group" id="group-3" value = "3">
                                        <label>گروه سوم</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="margin-top:15px;">
                                    <div class="form-group">
                                        <input type="text" name="description_owner" id="description-owner" class="form-control" placeholder="توضیحات">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="user_id" id="user-id" class="form-control show-user">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END Modal Edit -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-01 Modal For Edit Form -->

    <script>
        $(document).ready(function(){
            $('.btn-send-ajax').click(function(){
                var urlEdit = $(this).attr('href');
                // alert(urlEdit);
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#owner').val(data.owner);
                    $('#manager-owner').val(data.manager_owner);
                    $('#email-owner').val(data.email_owner);
                    $('#tell-owner').val(data.tell_owner);
                    $('#fax-owner').val(data.fax_owner);
                    $('#address-owner').val(data.address_owner);

                    // $('#groupo-1').val(data.kind_group);

                    $('#description-owner').val(data.description_owner);
                    $('#user-id').val(data.user_id);

                    if(data.kind_group == 1)
                    {
                        // alert('1');
                        $('#group-1').prop("checked" , true)  // .checkboxradio("refresh")
                        // $('#kind-radio').prop('checked', true)

                        // $('#group-2').checkboxradio('disable' , true);
                        // $('#group-3').checkboxradio('disable' , true);

                        // $('#group-2').attr('checked' , false)
                        // $('#group-3').attr('checked' , false)
                        // $('#group-1').attr('checked' , true)
                    }else if(data.kind_group == 2)
                    {
                        // alert('2');

                        $('#group-2').prop("checked" , true)  // .checkboxradio("refresh")

                    }else if(data.kind_group == 3)
                    {
                        // alert('3');
                        // alert($('#group-3').prop("checked" , true).checkboxradio("refresh"));

                        $('#group-3').prop("checked" , true) //.checkboxradio("refresh")
                    }

                    var urlUpdate = '/owner/' + data.id;
                    // alert(urlUpdate);
                    $('.edit-owner').attr('action' , urlUpdate);

                });
            });
        });
    </script>
    
@endsection

