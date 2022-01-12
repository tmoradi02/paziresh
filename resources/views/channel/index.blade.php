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

    @can('Insert_Channel')  <!-- Check Access For Permission User --> 
        <a href="{{route('channel.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن شبکه</a>
    @endcan

    <br>
    <br>

    <div class="card mx-auto">
        <div class="card-body">
        
            <table class="table table-bordered mx-auto" style="max-width:100%; max-height:100%; ">
                <tr Style="height: 1px;">
                    <th style="width:1% ; background-color:darkgray; text-align:center;">ردیف</th>     <!--height: 1px; -->
                    <th style="width:15% ; background-color:darkgray; text-align:center;">عنوان شبکه</th>     <!--height: 1px; -->
                    <th style="width:6% ; background-color:darkgray; text-align:center;">مشخصه شبکه</th>
                    <th style="width:8% ; background-color:darkgray; text-align:center;">نوع شبکه</th>

                    @can('Get_Permission_To_Other_User')
                        <th style="width:50px; background-color:darkgray; text-align:center;">کاربر</th>
                    @endcan

                    <th style="width:300px; background-color:darkgray; ">action</th>     <!--height: 1px; -->
                </tr>
                
                @foreach($channels as $channel)
                    <tr class="rowt" style="height: 1px; ">
                        <td class="rowtt" style="height: 1px; text-align:center;"></td>
                        <td style="height:1px;">{{$channel->channel_name}} </td>
                        <td style="height:1px;">{{$channel->degree}}</td>
                        @if($channel->kind == 1)
                            <td>تلویزیونی</td>
                        @elseif($channel->kind == 2)
                            <td>رادیویی</td>
                        @endif
                        
                        @can('Get_Permission_To_Other_User') <!-- Check Access For Permission User -->         
                            @foreach($users as $user)
                                @if($user->id == $channel->user_id)
                                    <td>{{$user->name}}</td>
                                @endif
                            @endforeach
                        @endcan
                        
                        <td class="btn-group" style="height:1%;">
                            @can('Edit_Channel') <!-- Check Access For Permission User --> 
                                <!-- <a href="{{route('channel.edit', $channel->id)}}" class="btn btn-warning btn-send-json" id="btn-table" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a> -->
                                <a href="{{route('channel.edit' , $channel->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @can('Delete_Channel')  <!-- Check Access For Permission User --> 
                                <form class="delete" action="{{route('channel.destroy' , $channel->id)}}" method="post">
                                    <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
                                    @csrf
                                    @method('delete')
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    <!-- ST DOC 1400-08-22 New Record Form -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن شبکه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add Form -->
                    <form action="{{route('channel.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="channel_name" class="form-control" placeholder="عنوان شبکه">
                                </div>
                                <div class="col form-group">
                                    <input type="number" name="degree" placeholder="مشخصه شبکه" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name="kind" id="1" value="1" checked>
                                        <label>تلویزیون</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="kind" id="2" value="2">
                                        <label>رادیویی</label>
                                    </div>
                                </div>

                                <div class="col form-group">
                                    @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                                        <select name="user_id" class="form-control show-user" >
                                        </select>
                                    @endcan
                                </div>

                            </div>
                            <div class="row">   
                                <div class="col form-group" >
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
                    <!-- Add Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-22 New Record Form -->

    <!-- Modal Edit Form -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title" id="editModalLabel">ویرایش شبکه</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span> 
                    </button> 
                </div> 

                <div class="modal-body"> 
                    <!-- Add Form For Edit --> 
                    <form action="" class="edit-channel" method="post">
                        @csrf
                        @method('put')

                        <div class="container">
                            <div class="row">
                        
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="channel_name" maxlength="50" placeholder="عنوان شبکه" class="form-control"   style="width:300px;" id="channel-name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="degree" id="degree" step="any" placeholder="مشخصه شبکه" class="form-control" style="width:100px;" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="radio" name = "kind" id = "kind-tv" value="1" >
                                        <label>تلویزیونی</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name = "kind" id = "kind-radio" value="2">
                                        <label>رادیویی</label>
                                    </div>
                                </div>

                                @can('Get_Permission_To_Other_User') <!-- Check Access For Permission User --> 
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="user_id" id="user-id" class="form-control show-user" style="width:300px;">

                                            </select>
                                        </div>
                                    </div>
                                @endcan

                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary">
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
                            </div> 

                        </div>
                    </form>
                    <!-- Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>

    <!-- <a href="" class="btn btn-warning test"><i class="fa fa-pencil-alt"></i></a> -->

    <script>
        $(document).ready(function(){ 
            $('.btn-send-ajax').click(function(){ 
                var urlEdit = $(this).attr('href');  // href To CurrentUrl 

                $.ajax({ url:urlEdit })
                .done(function(data){ 
                    
                    $('#channel-name').val(data.channel_name); 
                    $('#degree').val(data.degree); 
                    $('#user-id').val(data.user_id); 
                    
                    if (data.kind == 1) {    
                        $('#kind-tv').prop('checked' , true)
                    } else if(data.kind == 2){
                        $('#kind-radio').prop('checked', true)
                    }
                    
                    var urlUpdate = '/channel/' + data.id ; 
                    $('.edit-channel').attr('action' , urlUpdate); 
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

<!-- {{route('channel', 32)}} -->

 
                     

