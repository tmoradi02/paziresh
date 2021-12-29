@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-20 پیغام خطا به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOc 1400-09-20 پیغام خطا به کاربر -->

    <a href="{{route('user.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن کاربر</a>
    <br>
    <br>

    <!-- ST DOC 1400-07 Form For Search -->
    <form action="{{route('user_search')}}" method="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">جستجو</label>
        <div style="border:1px ridge lightblue; padding:10px; height:65px; margin-left:150px; width:1600px;" >
            <div class="row">

                <div class="col">
                    <div class="form-group d-flex" style="width:400px;">
                    <label for="user-name" class="col-3">نام کاربر</label>
                        <input type="text" name="name" id="user-name" placeholder="نام کاربر" class="form-control col-8" style="margin-right:-25px;">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group d-flex" style="width:300px;">
                        <label for="email" style="margin-right:20px;">ایمیل</label>
                        <input type="text" name="email" id=email placeholder="ایمیل" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group d-flex" style="width:300px;">
                        <label for="tell" style="margin-right:60px;">تلفن</label>
                        <div>
                            <input type="text" name="tell" placeholder="تلفن" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="padding-top:10px; margin-right:100px;">
                        <input type="radio" name="status" id="1" value="1">
                        <label>فعال</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="padding-top:10px; ">
                        <input type="radio" name="status" id="0" value="0">
                        <label>غیر فعال</label>
                    </div>
                </div>

                <!-- <div class="col" style="background-color:darkgray;">
                    <div class="form-group" style="width:300px;">
                        <select name="permission_id" id="myselect" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->permission_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> -->

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary" style="margin-right:70px;">
                    </div>
                </div>

            </div>
        </div>
    </form>
    <!-- END DOC 1400-07 Form For Search -->

    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1%; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:15%; background-color:darkgray; text-align:center;">نام کاربر</th>
            <th style="width:20%; background-color:darkgray; text-align:center;">ایمیل</th>
            <th style="width:20%; background-color:darkgray; text-align:center;">تلفن</th>
            <!-- <th style="width:150px; background-color:darkgray; text-align:center;">وضعیت</th> -->
            <th style="width:50px; background-color:darkgray; text-align:center;">Action</th>
            <!-- <th style="width:150px; background-color:lightgray; text-align:center;">کلمه عبور</th> -->
        </tr>

        @foreach($users as $user)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$user->name}}</td>
                <td style="height:1px;">{{$user->email}}</td>
                <td style="height:1px;">{{$user->tell}}</td>

                <!-- ST LOCK 1400-09-28 این قسمت به ستون دکمه ها منتقل شد
                @if($user->status == 1)
                    <td style="height:1px;">فعال</td>
                @elseif($user->status == 0)
                    <td style="height:1px;">غیر فعال</td>
                @endif  ENd DOC 1400-09-28 این قسمت به ستون دکمه ها منتقل شد -->

                <!-- <td style="height:1px;">{{$user->password}}</td> -->
                <td class="btn-group">
                    {{$user->status ? '😃' : '☹'}}

                    @can('Edit_User')
                        <a href="{{route('user.edit' , $user->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#editModal" id="btn-table"><i class="fa fa-pencil-alt"></i></a>
                    @endcan
                    
                    @can('Delete_User')
                        <form class="delete" action="{{route('user.destroy' , $user->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC 1400-09-02 Modal Form For Create New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST New Record Form -->
                    <form action="{{route('user.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="نام کاربر" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="ایمیل کاربر" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="tell" placeholder="شماره تلفن کاربر" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="password" placeholder="کلمه عبور" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="height" style="height:200px; overflow-y:scroll; padding:30px; border: 1px ridge lightblue;">
                                @foreach($permissions as $permission)
                                    <div class="row">
                                        <input type="checkbox" name="prm[]" value="{{$permission->id}}">
                                        <label>{{$permission->permission_name}}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row" style="border:1px ridge lightblue; margin-top:10px; padding-top:15px; margin-right:1px; padding-right:5px; margin-left:1px;" >
                                
                                <div class="col" >
                                    <div class="form-group">
                                        <input type="radio" name="status" id="Active" value="1" checked>
                                        <label>فعال</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="status" id="Inactive" value="0">
                                        <label>غیرفعال</label>
                                    </div>
                                </div>
                                
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END New Record Form -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-02 Modal Form For New Record -->

    <!-- ST DOC 1400-09-06 Modal Form For Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form action="" class="edit-user" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="نام کاربر" class="form-control" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="email" name="email" id="emails" class="form-control" placeholder="ایمیل کاربر">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="tell" id="tell" class="form-control" placeholder="تلفن کاربر">
                                    </div>
                                </div>
                            </div>

                            <div class="height" style="height:220px; overflow-y:scroll; padding:30px;">
                                @foreach($permissions as $permission)
                                    <div class="row">
                                        <input type="checkbox" class="roles" name="prm[]" value="{{$permission->id}}">
                                        <label>{{$permission->permission_name}}</label>
                                    </div>
                                @endforeach
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="status" id="active" value="1">
                                        <label>فعال</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="status" id="inActive" value="0" >
                                        <label>غیر فعال</label>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                            <div class="row"> 

                                <div class="col"> 
                                    <div class="form-group"> 
                                        <input type="submit" value="ثبت" class="btn btn-primary"> 
                                    </div> 
                                </div> 
                                <div class="col"> 
                                    <div class="from-group"> 
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                    </div> 
                                </div> 
                                <div class="col"></div> 
                                <div class="col"></div> 
                                <div class="col"></div> 
                            </div> 
                        </div> 
                    </form> 
                    <!-- Edit Form -->
                </div> 
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-06 Modal Form For Edit -->

    <script>

        $(document).ready(function(){
            $('.btn-send-ajax').click(function(){
                
                var urlEdit = $(this).attr('href');
                $.ajax({ 
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#name').val(data.user.name);
                    $('#emails').val(data.user.email);
                    $('#tell').val(data.user.tell);

                    for (var i=0; i<data.permissions.id; i++) 
                    { 
                        console.log(data.permissions[i].permission_name); 
                        var label = document.getElementsByName('permission_name')[0]; 
                        label.value = data[i].permission_name;
                        // label.checked = true;
                        data[i].checked = true;
                        // $(perm).prop(parameter);
                    };

                    if (data.user.status == 1) 
                    { 
                        $('#active').prop('checked' , true ) 
                    }else if(data.user.status == 0) 
                    { 
                        $('#inActive').prop('checked' , true ) 
                    } 

                    $('.roles').prop('checked' , false) 
                    $('.roles').each((index , item) => { 
                        $.each(data.user.roles , function(index , val){ 
                            if(val.id == $(item).val()){ 
                                $(item).prop('checked' , true) 
                                // console.log($(item).prop('checked' , true)) 
                            }
                        })
                    })

                    var urlUpdate = '/user/' + data.user.id;
                    $('.edit-user').attr('action' , urlUpdate);
                });
                // alert(urlEdit);
            });

        });

        // ST DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki by User 
        $(document).ready(function(){ 
            $('.delete').on('submit' , (e)=>{ 
                if(! confirm('آیا از حذف اطمینان دارید؟')){ 
                    e.preventDefault(); 
                } 
            }) 
        }) 
        // END DOC 1400-10-06 Alarm Delete 


    </script>

@endsection


