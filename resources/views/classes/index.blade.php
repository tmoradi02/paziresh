@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام خطا به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام خطا به کاربر -->

    @can('Insert_Classes') <!-- Check Access For Permission User --> 
        <a href="{{route('classes.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن طبقه</a>
    @endcan

    <br>
    <br>
    
    <form action="{{route('classes_search')}}" method="get">
                
        <div class="card" style=" margin-right:20px; margin-left:20px;">
            <div class="card-header" style="font-weight:bold; color:gray; ">جستجو</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md">
                        <div class="form-group d-flex">
                            <label for="myselect">شبکه</label>
                            <div>
                                <select name="channel_id" id="myselect" multiple>
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}">{{$channel->channel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group d-flex" style="width:200px; margin-right:50px; ">
                            <label for="class-name">طبقه</label>
                            <input type="text" name="class_name" id="class-name" placeholder="جستجوی عنوان طبقه" class="form-control">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group" style="margin-right:60px; ">
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </form>

    <br>

    <div class="card">
        <div class="card-body">
        
            <table class="table table-bordered" style="max-width:100%; ">
                <tr style="height:1px;">
                    <th style="width:1% ; background-color:darkgray; text-align:center;">ردیف</th>
                    <th style="width:15% ; background-color:darkgray; text-align:center;">شبکه</th>
                    <th style="width:7% ; background-color:darkgray; text-align:center;">عنوان طبقه</th>
                    @can('Get_Permission_To_Other_User')
                        <th style="width:100px; background-color:darkgray; text-align:center;">کاربر</th>
                    @endcan
                    <th style="width:300px; background-color:darkgray; ">action</th>
                </tr>
                @foreach($channels as $channel) <!-- ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات  -->
                    @foreach($classes as $classe) 
                        @if($channel->id == $classe->channel_id) <!-- ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات  -->
                            <tr class="rowt" style="height:1px ;"> 
                                <td class="rowtt" style="height:1% ; text-align:center;"></td> 
                                <td class="height:1px ;">{{$channel->channel_name}}</td> <!-- ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقات  -->
                                <td class="height:1px ; width:5% ;">{{$classe->class_name}}</td> 

                                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                                    @foreach($users as $user)
                                        @if($user->id == $classe->user_id)
                                            <td style="width:20% ;">{{$user->name}}</td>
                                        @endif
                                    @endforeach
                                @endcan

                                <td class="btn-group" style="height:10%;">
                                    @can('Edit_Classes')  <!-- Check Access For Permission User --> 
                                        <!-- <a href="{{route('classes.edit' , $classe->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a> -->
                                        <a href="{{route('classes.edit' , $classe->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan
        
                                    @can('Delete_Classes')  <!-- Check Access For Permission User --> 
                                        <form class="delete" action="{{route('classes.destroy' , $classe->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    @endcan
                                </td>

                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
    


<!-- ST DOC Modal Add Form -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه نمودن طبقه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <!-- ST Add Form --> 
                    <form action="{{route('classes.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <!-- ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات -->
                                <div class="col">
                                    <div class="form-group">
                                        <select name="channel_id" class="form-control show-channel" >
                                        </select>
                                    </div>
                                </div>
                                <!-- END DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات -->

                                <div class="col form-group">
                                    <input type="text" name="class_name" class="form-control" placeholder="عنوان طبقه">
                                </div>
                            </div>

                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col">
                                        <div class="form-group" style="width:210px;">
                                            <select name="user_id" class="show-user form-control">
                                            </select>
                                        </div>
                                    </div>
                                @endcan

                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC Add Form -->
                </div>
            </div>
        </div>
    </div>
<!-- END DOC Modal Add Form -->

    <!-- Modal Edit Form-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش طبقه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="edit-Classes" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <!-- ST DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات  -->
                                <div class="col"> 
                                    <div class="form-group"> 
                                        <select name="channel_id" id="channel-id" class="form-control show-channel"> 
                                        </select> 
                                    </div>
                                </div>
                                <!-- END DOC 1400-09-08 اضافه نمودن ریلیشن شبکه به جدول طبقات -->

                                <div class="col form-group">
                                    <input type="text" name="class_name" id="class-names" placeholder="عنوان طبقه" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                            
                                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                                    <div class="col">
                                        <div class="form-group" style="width:200px;">
                                            <select name="user_id" id="user-id" class="form-control show-user">
                                        
                                            </select>
                                        </div>
                                    </div>
                                @endcan
                                
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- END Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>

    <script> 
        $(document).ready(function(){ 
            $('.btn-send-ajax').click(function(){ 
                var urlEdit = $(this).attr('href'); 
                // alert(urlEdit); 
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#channel-id').val(data.channel_id);
                    $('#class-names').val(data.class_name);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/classes/' + data.id;
                    $('.edit-Classes').attr('action' , urlUpdate);
                });
            }); 

            // ST DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e)=>{
                if(!confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
            // ENd DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
        }); 



    </script> 
@endsection


