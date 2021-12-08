@extends('layouts.app')
@section('content')

    @if($errors->any())
        <div class="alert-box">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif

    <a href="{{route('tariff.create')}}" data-toggle="modal" data-target="#createModal" class="next">اضافه نمودن تعرفه</a>
    
    <br>
    <br>



    <form action="{{route('tariff_search')}}" method="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">TARIFF</label>
        <div style="border:1px ridge lightblue; padding-right:10px; margin-right:20px; padding-top:10px; margin-left:20px; height:60px;">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select name="channel_id" id="myselect" multiple class="form-control" style="width:200px;">
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}" style="width:200px;">{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="classes_id" id="myselect-2" multiple class="form-control">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="box_type_id" id="myselect-3" multiple class="form-control">
                            @foreach($box_types as $boxtype)
                                <option value="{{$boxtype->id}}">{{$boxtype->box_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input name="from_date" autocomplete="off" data-jdp class="form-control" placeholder="از تاریخ">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input name="to_date" autocomplete="off" data-jdp class="form-control" placeholder="تا تاریخ">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="number" name="price" placeholder="مبلغ تعرفه" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="user_id" id="myselect-4" multiple class="form-control"> 
                            @foreach($users as $user) 
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </div>
        
        </div>
        <div class="row">
        
        </div>
    </form>


    <!-- END DOC 1400-09-15 -->
    <table class="table table-bordered" style="margin-top:10px;">
        <tr style="height:1px;">
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">شبکه</th>
            <th style="width:50px; background-color:darkgray; text-align:center;">طبقه</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">نوع باکس</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">از تاریخ</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">تا تاریخ</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">مبلغ</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">کاربر</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">Action</th>
        </tr>

        @foreach($channels as $channel)
            @foreach($tariffs as $tariff)
                @if($channel->id == $tariff->channel_id)
                    <tr class="rowt" style="height:1px;">
                        <td class="rowtt" style="height:1px; text-align:center;"></td>
                        <td style="height:10%; width:10px;">{{$channel->channel_name}}</td>

                        @foreach($classes as $classe)
                            @if($classe->id == $tariff->classes_id)
                                <td style="height:10%; width:10px;">{{$classe->class_name}}</td>
                            @endif
                        @endforeach

                        @foreach($box_types as $box_type)
                            @if($box_type->id == $tariff->box_type_id)
                                <td style="height:10%; ">{{$box_type->box_type}}</td>
                            @endif
                        @endforeach

                        <td style="height:10%;">{{$tariff->from_date}}</td>
                        <td style="height:10%;">{{$tariff->to_date}}</td>
                        <td style="height:10%;">{{$tariff->price}}</td>

                        @foreach($users as $user)
                            @if($user->id == $tariff->user_id)
                                <td style="height:10%;">{{$user->name}}</td>
                            @endif
                        @endforeach

                        <td class="btn-group" style="height:10%;">
                            @can('Edit_Tariff')
                                <a href="{{route('tariff.edit' , $tariff->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt" style="height:10%;"></i></a>
                                <!-- <a href="{{route('tariff.edit' , $tariff->id)}}" class="btn btn-warning"><i class="fa-primary"></i></a> -->
                            @endcan

                            @can('Delete_Tariff')
                                <form action="{{route('tariff.destroy' , $tariff->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"><i class="fa fa-trash-alt" style="height:10%;"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>

    <!-- ST DOC 1400-09-13 Modal Form For Create New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن تعرفه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal Form Create -->
                    <form action="" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="channel_id" id="channel-id" class="form-control show-channel">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select name="classes_id" id="classes-id" class="form-control show-class"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="box_type_id" id="boxType-id" class="form-control show-boxType"></select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="price" id="price" class="form-control" placeholder ="مبلغ تعرفه">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp name= "from_date" placeholder="از تاریخ" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp name="to_date" placeholder="تا تاریخ" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="user_id" id="user-id" class="form-control show-user" style="width:210px;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Modal Form Create -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-13 Modal Form for Create New Record -->


    <!-- ST DOC 1400-09-13 Modal Form For Edit Record -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش تعرفه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form action="" class="edit-tariff" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="channel_id" id="channels-id" class="form-control show-channel">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select name="classes_id" id="class-id" class="form-control show-class">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="box_type_id" id="boxTypes-id" class="form-control show-boxType">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="price" id="prices" class="form-control" placeholder="مبلغ"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp class="form-control" name="from_date" id="from-date">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp class="form-control" name="to_date" id="to-date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="user_id" id="users-id" class="form-control show-user" style="width:210px;">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Edit Form -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-13 Modla form For Edit Record -->

    <!-- ST DOC 1400-09-15 -->
    <!-- <form action="{{route('tariff_search')}}" method="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">Search</label>

        <div style="border:1px ridge lightblue; padding-right:10px; margin-right:20px; padding-top:10px; margin-left:20px; height:60px; width:1780px; " >
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select name="channel_id" class="form-control" id="myselect" multiple style="width:200px;" >
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}" style="width:100px;">{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="classes_id" id="myselect-2" class="form-control" multiple style="width:200px;">
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input name="from_date" data-jdp class="form-control" placeholder="از تاریخ" style="width:200px;">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input name="to_date" data-jdp class="form-control" placeholder="تا تاریخ" style="width:200px;">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="box_type_id" id="myselect-3" class="form-control" multiple style="width:200px;">
                            @foreach($box_types as $boxtype)
                                <option value="{{$boxtype->id}}">{{$boxtype->box_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="number" name="price" id="" class="form-control" style="width:200px;">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="user_id" id="myselect-4" class="form-control" multiple style="width:300px;">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>
            </div>
        
        </div>
    </form> -->

    <script>
        $(document).ready(function(){ 
            $('.btn-send-ajax').click(function(){ 
                var urlEdit = $(this).attr('href'); 
                // alert(urlEdit);
                $.ajax({ 
                    url:urlEdit 
                }).done(function(data){ 
                    // console.log(data); 
                    $('#channels-id').val(data.channel_id); 
                    $('#class-id').val(data.classes_id);
                    $('#boxTypes-id').val(data.box_type_id);
                    $('#from-date').val(data.from_date);
                    $('#to-date').val(data.to_date);
                    $('#prices').val(data.price);
                    $('#users-id').val(data.user_id);

                    var urlUpdate = '/tariff/' + data.id; 
                    $('.edit-tariff').attr('action',urlUpdate); 
                }); 
            });  
        }); 

    </script>

@endsection