@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام دادن به کاربر -->
    @if($errors->any())
        <div class="alert-box">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام دادن به کاربر -->

    <!-- <a href="{{route('adver_type.create')}}" class="btn btn-primary" style="margin-right:20px; text-align: center; width:210px;">اضافه نمودن نوع کدآگهی</a> -->
    <a href="{{route('adver_type.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن نوع کدآگهی</a>
    <br>
    <br>

    <form action="{{route('adver_type_search')}}" method="get">
        <label style="padding-right:40px; font-weight:bold; color:gray;">جستجو</label>
        <!-- <div class="container"> -->
            <div style="padding-right:20px;">
                <div class="row" style="border:1px ridge lightblue; margin-right:10px; padding-top:15px; width:550px; padding-right:10px;">
        
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
    
    <br>
 
    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">نوع کدآگهی</th>
            @can('Get_Permission_To_Other_User')
                <th style="width:200px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
            <th style="width:300px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($adver_types as $adver_type)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$adver_type->adver_type}}</td>

                @can('Get_Permission_To_Other_User')
                    @foreach($users as $user)
                        @if($user->id == $adver_type->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group" style="height:1px;">
                    @can('Edit_Adver_Type')
                        <a href="{{route('adver_type.edit' , $adver_type->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Adver_Type')
                        <form action="{{route('adver_type.destroy', $adver_type->id)}}" method="post">  
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC Modal For New Record Form -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن نوع کدآگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC New Record Form --> 
                    <form action="{{route('adver_type.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="adver_type" class="form-control" placeholder="عنوان نوع کدآگهی">
                                </div>
                            </div>
                            @can('Get_Permission_To_Other_User')
                                <div class="row">
                                    <div class="col form-group">
                                        <select name="user_id" class="form-control show-user">
                                        </select>
                                    </div>
                                </div>
                            @endcan
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC New Record Form -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- END DOC Modal For New Record Form -->

    <!-- ST DOC Modal For Form Edit -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش نوع کدآگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Add Form For Edit -->
                        <form action="" class="edit-adver-type" method="post">
                            @csrf
                            @method('put')
                            <div class="container">
                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" name="adver_type" id="adver-type" class="form-control" placeholder="عنوان نوع کداگهی">
                                    </div>
                                </div>
                                <div class="row">
                                    @can('Get_Permission_To_Other_User')
                                        <div class="col form-group">
                                            <select name="user_id" id="user-id" class="form-control show-user">

                                            </select>
                                        </div>
                                    @endcan
                                        <div class="row">
                                        <div class="col form-group">
                                            <input type="submit" value="ثبت" class="btn btn-primary">
                                        </div>
                                        <div class="col form-group">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <!-- END DOC Add Form For Edit -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC Modal For Form Edit -->

    <script>
        $(document).ready(function(){
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#adver-type').val(data.adver_type);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/adver_type/' + data.id;
                    $('.edit-adver-type').attr('action' , urlUpdate);
                })
                // alert(urlEdit);
            });
        });

    </script>
@endsection