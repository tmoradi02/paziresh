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
    <!-- ST DOC 1400-09-17 پیغام خطا به کاربر -->

    @can('Insert_Box_Type')  <!-- check Access For Permission User --> 
        <a href="{{route('box_type.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن محل پخش</a>
    @endcan

    <br>
    <br>

    <table class="table table-bordered" style="max-width:100%;"> 
        <tr style="height:1px;"> 
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th> 
            <th style="width:50px; background-color:darkgray; text-align:center;">نوع باکس</th> 
            @can('Get_Permission_To_Other_User') 
                <th style="width:70px; background-color:darkgray; text-align:center;">کاربر</th> 
            @endcan 
            <th style="width:200px; background-color:darkgray; ">Action</th> 
        </tr> 

        @foreach($box_types as $box_type)
            <tr class="rowt" style="height:1px; ">
                <td class="rowtt" style="height:1px; width:1%; text-align:center;"></td>
                <td style="height:1px; width:10%; ">{{$box_type->box_type}}</td>
                
                @can('Get_Permission_To_Other_User') <!-- Check Access For Permission User --> 
                    @foreach($users as $user)
                        @if($user->id == $box_type->user_id)
                            <td style="width:20%; ">{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan

                <td class="btn-group">
                    @can('Edit_Box_Type')  <!-- Check Access For Permission User --> 
                        <a href="{{route('box_type.edit' , $box_type->id)}}" class="btn btn-warning btn-send-json" id="btn-table" data-toggle="modal" data-target = "#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Type')  <!-- Check Access For Permission User --> 
                        <form class="delete" action="{{route('box_type.destroy' , $box_type->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC 1400-08-30 Modal For New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن محل پخش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Create Form -->
                    <form action="{{route('box_type.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="box_type" placeholder="محل پخش" class="form-control">
                                    </div>
                                </div>
                                @can('Get_Permission_To_Other_User')
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="user_id" class="form-control show-user">
                                            </select>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- Create Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-30 Modal For New Record -->
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش محل پخش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="edit-box-type" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="box_type" id="box-type" class="form-control" placeholder="عنوان محل پخش">
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
                    // console.log(data);
                    $('#box-type').val(data.box_type);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/box_type/' + data.id;
                    $('.edit-box-type').attr('action' , urlUpdate);
                });
                // alert(urlEdit);
            });

            // ST DOC 1400-10-06 Alaram Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e)=>{
                if(!confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
            // END DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
        });


    </script>
@endsection



