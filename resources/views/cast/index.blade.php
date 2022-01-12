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
    
    @can('Insert_Cast') <!-- Check Access For Permission User --> 
        <a href="{{route('cast.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن اصناف</a>
    @endcan 
    
    <br>
    <br>
    
    <form action="{{route('cast_search')}}" method="get">
        <div class="card" style="margin-right:10px; margin-left:10px;">
            <div class="card-header" style="font-weight:bold; color:gray;">جستجو</div>
            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <div class="form-group d-flex" style="width:350px;">
                            <label for="casts">صنف</label>
                            <input type="text" name="cast" id="casts" placeholder="جستجو عنوان صنف" class="form-control">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group" style="margin-left:10px;">
                            <input type="submit" value="جستجو" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    </form>

    <br>
    
    <table class="table table-bordered" style="max-width:100%; max-height:100%; margin-top:-10px; mx-auto;">
        <tr style="height:1px;">
            <th style="width:1% ; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:25% ; background-color:darkgray; text-align:center;">عنوان صنف</th>

            @can('Get_Permission_To_Other_User') <!-- Check Access For Permission User --> 
                <th style="width:20% ; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan

            <th style="width:50px ; background-color:darkgray; ">Action</th>
        </tr>
        
        @foreach($casts as $cast)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$cast->cast}}</td>

                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                    @foreach($users as $user)
                        @if($user->id == $cast->user_id)
                            <td>{{$user->name}}</td>
                        @endif
                    @endforeach
                @endcan
                
                <td class="btn-group" style="height:10%;">
                    @can('Edit_Cast') <!-- Check Access For Permission User --> 
                    <a href="{{route('cast.edit' , $cast->id)}}" class="btn btn-warning btn-send-json" id="btn-table" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Cast')  <!-- Check Access For Permission User --> 
                        <form class="delete" action="{{route('cast.destroy' , $cast->id)}}" method="post">
                            @csrf
                            @method('delete')
                                <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt" ></i></button>
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
                                @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
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

            // ST DOC 1400-10-06 Alaram Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e)=>{
                if(! confirm('آیا از حذف اطمینان دارید')){
                    e.preventDefault();
                }
            })
            // END DOC 1400-10-06 Alaram Delete For User Before Delete Fiziki By User 

        });

    </script>
@endsection

      

