@extends('layouts.app')
@section('content')

    <a href="{{route('classes.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن طبقه</a>
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
            @can('Get_Permission_To_Other_User')
                <th style="width:200px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
            <th style="width:300px; background-color:darkgray; ">action</th>
        </tr>
        @foreach($classes as $classe)
            <tr class="rowt" style="height: 1px;">
                <td class="rowtt" style="height: 1px; text-align:center;"></td>
                <td class="height:1px;">{{$classe->class_name}}</td>

                @can('Get_Permission_To_Other_User')
                    @foreach($users as $user)
                        @if($user->id == $classe->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group" style="height: 1px;">
                    @can('Edit_Classes')
                        <a href="{{route('classes.edit', $classe->id )}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
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

<!-- ST DOC Modal Add Form -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                <div class="col form-group">
                                    <input type="text" name="class_name" class="form-control" placeholder="عنوان طبقه">
                                </div>
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" class="show-user form-control">
                                        </select>
                                    </div>
                                @endcan
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>

                    <!-- END DOC Add Form -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
<!-- END DOC Modal Add Form -->

    <!-- Modal Edit Form-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش طبقه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="Edit-classes" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="class_name" id="class-name" placeholder="عنوان طبقه" class="form-control">
                                </div>

                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" id="user-id" class="form-control show-user">

                                        </select>
                                    </div>
                                @endcan
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
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
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                    }).done(function(data){
                    //    console.log(data) ;
                       
                        $('#class-name').val(data.class_name);
                        $('#user-id').val(data.user_id);

                        var urlUpdate = '/classes/' + data.id;
                        // alert(urlEdit);
                        $('.Edit-classes').attr('action' , urlUpdate);
                });
            });
        });
    </script>
@endsection


