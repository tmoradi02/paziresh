@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-21 پیغام خطا به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-21 پیغام خطا به کاربر -->
    
    @can('Insert_Cast')
        <a href="{{route('cast.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن اصناف</a>
    @endcan

    <br>
    <br>
    
    <form action="{{route('cast_search')}}" method="get">
        <label style="margin-right:30px; font-weight:bold; color:gray;">جستجو</label>
        <div style="margin-right:30px;">
            <div class="row" style="border:1px ridge lightblue; width:600px; padding:15px 0px; height:70px;" >
                <div class="col">
                    <div class="form-group" style="width:470px;">
                        <input type="text" name="cast" placeholder="جستجو عنوان صنف" class="form-control">
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
            <th style="width:10px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">عنوان صنف</th>

            @can('Get_Permission_To_Other_User')
                <th style="width:100px; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan

            <th style="width:100px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($casts as $cast)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$cast->cast}}</td>

                @can('Get_Permission_To_Other_User')
                    @foreach($users as $user)
                        @if($user->id == $cast->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan
                
                <td class="btn-group" style="height:1px;">
                    @can('Edit_Cast')
                    <a href="{{route('cast.edit' , $cast->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Cast')
                        <form action="{{route('cast.destroy' , $cast->id)}}" method="post">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger"><i class="fa fa-trash-alt" ></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC Modal From For Edit-->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن صنف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Form For Create -->
                    <form action="{{route('cast.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="cast" placeholder="عنوان صنف" class="form-control">
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
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- Add From For Edit -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC Modal From For Edit-->

    <!-- ST DOC Modal From For Edit-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش صنف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="edit-cast" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="cast" id="cast" class="form-control" placeholder="عنوان صنف">
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
                    <!-- END Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC Modal From For Edit-->

    <script>
        $(document).ready(function(){
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                    }).done(function(data){
                        // console.log(data);
                        $('#cast').val(data.cast);
                        $('#user-id').val(data.user_id);

                        var urlUpdate = '/cast/' + data.id;
                        $('.edit-cast').attr('action' , urlUpdate);
                });
                // alert(urlEdit);
            });
        });
    </script>
@endsection

      

