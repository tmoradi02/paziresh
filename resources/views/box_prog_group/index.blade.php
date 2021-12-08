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
    <!-- END DOC 1400-09-17 پیغام دادن به کاربر  -->

    <a href="{{route('box_prog_group.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن گروه برنامه</a>
    <br>
    <br>

    <form action="{{route('box_prog_group_search')}}" method="get">
        <label style="padding:15px; font-weight:bold; color:gray;margin-right:20px;">جستجو</label>
        <div style="margin-right:10px;">
            <div class="row" style="border:1px ridge lightblue; width:700px; margin-right:15px; padding:15px 0px; height:75px;">
            
                <div class="col">
                    <div class="form-group" style="width:570px;">
                        <input type="text" name="prog_group" placeholder="جستجو عنوان برنامه" class="form-control" >
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </form>
    
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">عنوان برنامه</th>
            @can('Get_Permission_To_Other_User')
                <th style="width:100px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
            <th style="width:300px; background-color:darkgray;"> Action</th>
        </tr>
        @foreach($box_prog_groups as $box_prog_group)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$box_prog_group->prog_group}}</td>

                @can('Get_Permission_To_Other_User')
                    @foreach($users as $user)
                        @if($user->id == $box_prog_group->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan
                <td class="btn-group" style="height:1px;">
                    @can('Edit_Box_Prog_Group')
                        <a href="{{route('box_prog_group.edit' , $box_prog_group->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Prog_Group')
                        <form action="{{route('box_prog_group.destroy' , $box_prog_group->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC 1400-08-29 Modal For New Record Form -->
<!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافه نمودن گروه برنامه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Modal 1400-08-29 -->
                    <form action="{{route('box_prog_group.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="prog_group" placeholder="گروه برنامه" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" class="form-control show-user">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- ENd DOC Modal 1400-08-29 -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-29 Modal For New Record Form -->

    <!-- ST DOC 1400-08-20 Modal For Edit Form -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش گروه برنامه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="edit-box-prog-group" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="prog_group" id="prog-group" class="form-control" placeholder="عنوان گروه برنامه">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" id="user-id" class="form-control show-user">
                                    
                                    </select>
                                </div>
                            </div>
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
                    <!-- END Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-20 Modal For Edit Form -->

    <script>
        $(document).ready(function(){
            $('.btn-send-ajax').click(function(){
                var urlEdit = $(this).attr('href');
                // alert(urlEdit);
                $.ajax({
                    url:urlEdit
                    }).done(function(data){
                        // console.log(data);
                        $('#prog-group').val(data.prog_group);
                        $('#user-id').val(data.user_id);

                        var urlUpdate = '/box_prog_group/' + data.id;
                        $('.edit-box-prog-group').attr('action' , urlUpdate);
                    })
                // alert(urlEdit);
            });
        });

    </script>
@endsection 
