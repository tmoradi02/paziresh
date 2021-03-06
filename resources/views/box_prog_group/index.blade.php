@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام دادن به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام دادن به کاربر  -->

    @can('Insert_Box_Prog_Group')  <!-- Check Access For Permission User -->
        <a href="{{route('box_prog_group.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن گروه برنامه</a>
    @endcan

    <br>
    <br>

    <form action="{{route('box_prog_group_search')}}" method="get">

        <div class="card" style="margin-right:20px; margin-left:10px; width:550px; max-width:90%;">
            <div class="card-header" style="font-weight:bold; color:gray;">جستجو</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group d-flex" style="width:400px; max-width:100%;">
                            <label for="prog-group" class="col-4" style="padding-right:1px; margin-right:-10px;">عنوان برنامه</label>
                            <input type="text" name="prog_group" id="prog-group" placeholder="جستجو عنوان برنامه" class="form-control" style="margin-right:-20px;">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group">
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div style="margin-right:10px;"> -->
            <!-- <div class="row" style="border:1px ridge lightblue; margin-right:15px; padding:15px 0px; height:75px; width:700px; max-width:100%;"> -->
            <!-- <div class="row" style="border:1px ridge lightblue; padding-right:1px; padding-top:15px; margin-right:5px; width:550px; max-width:100%;">
                
                <div class="col">
                    <div class="form-group d-flex" style="width:400px; max-width:100%;">
                        <label for="prog-group" class="col-3" style="padding-right:1px; max-pr:100%;">عنوان برنامه</label>
                        <input type="text" id="prog-group" name="prog_group" placeholder="جستجو عنوان برنامه" class="form-control" >
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div> -->

    </form>
    
    <br>

    <table class="table table-bordered" style="max-width:100%; max-height:100%; ">
        <tr style="height:1px;">
            <th style="width:0px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">عنوان برنامه</th>

            @can('Get_Permission_To_Other_User')
                <th style="width:100px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
            <th style="width:100px; background-color:darkgray;"> Action</th>
        </tr>

        @foreach($box_prog_groups as $box_prog_group)
            <tr class="rowt">
                <td class="rowtt" style="height:1%; width:1%; text-align:center;"></td>
                <td style="height:1%; width:20%; ">{{$box_prog_group->prog_group}}</td>

                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                    @foreach($users as $user)
                        @if($user->id == $box_prog_group->user_id)
                            <td style="width:20%;">{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group" style="height:10%; width:1%; ">
                    @can('Edit_Box_Prog_Group')  <!-- Check Access For Permission User --> 
                        <a href="{{route('box_prog_group.edit' , $box_prog_group->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Prog_Group')  <!-- Check Access For Permission User --> 
                        <form class="delete" action="{{route('box_prog_group.destroy' , $box_prog_group->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
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
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" class="form-control show-user">
                                        </select>
                                    </div>
                                @endcan
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
                                    <input type="text" name="prog_group" id="prog-groups" class="form-control" placeholder="عنوان گروه برنامه">
                                </div>
                            </div>
                            <div class="row">
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
                        $('#prog-groups').val(data.prog_group);
                        $('#user-id').val(data.user_id);

                        var urlUpdate = '/box_prog_group/' + data.id;
                        $('.edit-box-prog-group').attr('action' , urlUpdate);
                    })
                // alert(urlEdit);
            });
        });

        // ST DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
        $(document).ready(function(){
            $('.delete').on('submit',(e)=>{
                if(! confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
        });
        // END DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 

    </script>
@endsection 
