@extends('layouts.app')
@section('content')

    <!-- <a href="{{route('channel.create')}}" class="next">اضافه نمودن شبکه</a> -->
    
    <a href="{{route('channel.store')}}" class="next btn-send-json-create" data-toggle="modal" data-target="#CreateModal">اضافه نمودن شبکه</a>

    <br>
    <br>
    
    <table class="table table-bordered">
        <tr Style="height: 1px;">
            <th style="width:10px; background-color:darkgray; text-align:center;">ردیف</th>     <!--height: 1px; -->
            <th style="width:100px; background-color:darkgray; text-align:center;">عنوان شبکه</th>     <!--height: 1px; -->
            <th style="width:50px; background-color:darkgray; text-align:center;">مشخصه شبکه</th>
            <th style="width:50px; background-color:darkgray; text-align:center;">نوع شبکه</th>
            <th style="width:50px; background-color:darkgray; text-align:center;">کاربر</th>
            <th style="width:300px; background-color:darkgray; ">action</th>     <!--height: 1px; -->
        </tr>
        
        @foreach($channels as $channel)
            <tr class="rowt" style="height: 1px; ">
                <td class="rowtt" style="height: 1px; text-align:center;"></td>
                <td style="height: 1px;">{{$channel->channel_name}} </td>
                <td style="height:1px;">{{$channel->degree}}</td>
                @if($channel->kind == 1)
                    <td>تلویزیونی</td>
                @elseif($channel->kind == 2)
                    <td>رادیویی</td>
                @endif
                @foreach($users as $user)
                    @if($user->id == $channel->user_id)
                        <td>{{$user->name}}</td>
                    @endif
                @endforeach
                <td class="btn-group" style="height: 1px;">
                    @can('Edit_Channel')
                        <a href="{{route('channel.edit', $channel->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                        <!-- <a href="{{route('channel.edit', $channel->id)}}" data-url = "{{route('channel.edit' , $channel->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a> -->
                    @endcan

                    @can('Delete_Channel')
                        <form action="{{route('channel.destroy' , $channel->id)}}" method="post">
                            
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            @csrf
                            @method('delete')
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

<!-- Modal Add Form -->
    <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Add Form For Add -->
                    <form action="" class="create-channel" method="post">
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
                                        <label>تلویزیونی</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="kind" id="2" value="2">
                                        <label>رادیویی</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <select name="user_id" id="" class="form-control show-user" style="width:300px;">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <input type="submit" value="ثبت" class="btn btn-primary">  
                            </div>
                        </div>
                    </form>
                    <!-- END Add Form-For Add -->
                </div>
                <div class="modal-footer">
                    <input type="submit" value="ثبت" class="btn btn-primary">  
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Edit Form -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش شبکه</h5> 
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

                                <div class="col">
                                    <div class="form-group">
                                        @can('Get_Permission_To_Other_User')
                                            <select name="user_id" id="user-id" class="form-control show-user" style="width:300px;">

                                            </select>
                                        @endcan
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                </div>     

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
            $('.btn-send-json').click(function(){ 
                var urlEdit = $(this).attr('href');  // href To CurrentUrl 

                $.ajax({ url:urlEdit })
                .done(function(data){ 
                                        
                    $('#channel-name').val(data.channel_name); 
                    $('#degree').val(data.degree); 
                    $('#user-id').val(data.user_id); 
                    
                    if (data.kind == 1) {    
                        $('#kind-tv').attr('checked' , true)
                    } else if(data.kind == 2){
                        $('#kind-radio').attr('checked', true)
                    }
                    
                    var urlUpdate = '/channel/' + data.id ; 
                    $('.edit-channel').attr('action' , urlUpdate); 
                });
            });

            // For Create 
            $('.btn-send-json-create').click(function(){
                var urlCreate = $(this).attr('href');
                    // alert(urlCreate);
                $.ajax({
                    url:urlCreate
                }).done(function(data){

                    var urlStore = '/channel.store';
                    $('.create-channel').attr('action' , urlStore);
                });
            });


        });

    </script>

@endsection 

<!-- {{route('channel', 32)}} -->

 
                     

