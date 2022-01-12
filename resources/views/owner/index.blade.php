@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام خطا به کاربر  -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام خطا به کاربر -->

    @can('Insert_Owner')  <!-- Check Access For Permission User --> 
        <a href="{{route('owner.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن صاحب آگهی</a>
    @endcan

    <br>
    <br>

    <!-- ST DOC 1400-10-08 Owner Search -->
    <form action="{{route('owner_search')}}" method="get">

        <!-- <div class="card" style="max-width:98%; ">
            <div class="card-header" style="font-weight:bold; color:gray;">جستجو</div>
            <div class="card-body"> -->
                
            <div class="row">
                <div class="col-md">
                    <div class="form-group d-flex" >
                        <label for="owner" class="col-5" style="margin-right:-20px;">صاحب آگهی</label>
                        
                        <input type="text" name="owner" placeholder="جستجو نام صاحب آگهی" class="form-control" id="owner" style="margin-right:-40px; ">
                    </div>
                </div>

                <div class="col-md" >
                    <div class="form-group d-flex">
                        <label for="manager-owner" class="col-4">مدیر عامل</label>

                        <input type="text" name="manager_owner" id="manager-owner" class="form-control" placeholder="جستجو مدیرعامل" style="margin-right:-20px;">
                    </div>
                </div>

                <div class="col-md" >
                    <div class="form-group d-flex">
                        <label for="email-owner">ایمیل</label>
                        <div>
                            <input type="text" name="email_owner" id="email-owner" class="form-control" placeholder="ایمیل" >
                        </div>
                    </div>
                </div>

                <div class="col-md" >
                    <div class="form-group d-flex">
                        <label for="tell-owner" >تلفن</label>
                        <div>
                            <input type="text" name="tell_owner" id="tell-owner" class="form-control" placeholder="تلفن">
                        </div>
                    </div>
                </div>

                <div class="col-md" >
                    <div class="form-group d-flex">
                        <label for="fax-owner">فکس</label>
                        <input type="text" name="fax_owner" id="fax-owner" class="form-control" placeholder="فکس" style="width:200px;" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="form-group d-flex">
                        <label for="address-owner">آدرس</label>
                        <input type="text" name="address_owner" id="address-owner" placeholder="آدرس" class="form-control">
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-group d-flex">
                        <label for="description-owner">توضیحات</label>

                        <input type="text" name="description_owner" id="description-owner" placeholder="توضیحات" class="form-control">
                    </div>
                </div>

                <div class="col-md" >
                    <div class="form-group">
                        <input type="radio" name="kind_group" id="1" value="1">
                        <label>گروه اول</label>
                    </div>
                </div>
                <div class="col-md" >
                    <div class="form-group">
                        <input type="radio" name="kind_group" id="2" value="2">
                        <label>گروه دوم</label>
                    </div>
                </div>
                <div class="col-md" >
                    <div class="form-group">
                        <input type="radio" name="kind_group" id="3" value="3">
                        <label>گروه سوم</label>
                    </div>
                </div>
                
                <div class="col-md" >
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>

        <!-- </div>
        </div> -->

    </form>  
    <!-- END DOC 1400-10-08 Owner Search -->

    <br>


    <table class="table table-bordered" style="max-width:100%;">
        <tr style="height:1px; ">
            <th style="width:10px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">نام صاحب آگهی</th>
            <th style="width:400px; background-color:darkgray; text-align:center;">نام مدیرعامل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">ایمیل</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">تلفن</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">فکس</th>
            <th style="width:1100px; background-color:darkgray; text-align:center;">آدرس</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">گروه</th>
            <th style="width:500px; background-color:darkgray; text-align:center;">توضیحات</th>
            @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                <th style="width:400px; background-color:darkgray; text-align:center;">کاربر</th>
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
                
                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                    @foreach($users as $user)
                        @if($user->id == $owner->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group" style="height:10%;">
                    @can('Edit_Owner')  <!-- Check Access For Permission User --> 
                        <a href="{{route('owner.edit' , $owner->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Owner')  <!-- Check Access For Permission User --> 
                        <form class="delete" action="{{route('owner.destroy' , $owner->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>   
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
                                        <input type="text" name="owner" id="owners" class="form-control" placeholder="عنوان صاحب آگهی">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="manager_owner" id="manager-owners" class="form-control" placeholder="نام مدیرعامل">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email_owner" id="email-owners" class="form-control" placeholder="ایمیل">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="tell_owner" id="tell-owners" class="form-control" placeholder="تلفن">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="fax_owner" id="fax-owners" class="form-control" placeholder="فکس">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="address_owner" id="address-owners" class="form-control" placeholder="آدرس">
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
                                        <input type="text" name="description_owner" id="description-owners" class="form-control" placeholder="توضیحات">
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
                    $('#owners').val(data.owner); 
                    $('#manager-owners').val(data.manager_owner); 
                    $('#email-owners').val(data.email_owner); 
                    $('#tell-owners').val(data.tell_owner); 
                    $('#fax-owners').val(data.fax_owner); 
                    $('#address-owners').val(data.address_owner); 

                    // $('#groupo-1').val(data.kind_group);

                    $('#description-owners').val(data.description_owner);
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

            // ST DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e)=>{
                if(! confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
            // END DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
        });

    </script>

@endsection

