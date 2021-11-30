@extends('layouts.app')
@section('content')

    <a href="{{route('tariff.create')}}" data-toggle="modal" data-target="#createModal" class="next">اضافه نمودن تعرفه</a>
    
    <br>
    <br>

    <table class="table table-bordered">
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

    <!-- ST DOC 1400-09-09 ADD Modal Form For Create New Record -->
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
                    <!-- ST DOC Form Create -->
                    <form action="{{route('tariff.store')}}" method="post">
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
                                        <select name="classes_id" id="classes-id" class="form-control show-class">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select name="box_type_id" id="box-type-id" class="form-control show-BoxType">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" name="price" id="price" class="form-control" placeholder="مبلغ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input data-jdp name="from_date" class="form-control" placeholder="از تاریخ">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input data-jdp name ="to_date" class="form-control" placeholder="تا تاریخ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group"  style="width:210px;">
                                        <select name="user_id" id="user-id" class="form-control show-user">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="submit" value="ثبت"  class="btn btn-primary">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC Form Create -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC 1400-09-09 ADD Modal Form For Create New Record -->


    <!-- ST DOC 1400-09-09 Edit Modal Form For Edit Record -->
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
                    <!-- ST DOC 1400-08-19 Add Form For Edit -->
                    <form action="" class="edit-tariff" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="" id="">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC 1400-08-19 Add Form For Edit -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ENd DOC 1400-09-09 Edit Modal Form For Edit Record -->

    <script>
        $(document).ready(function(){
            $('.btn-send-ajax').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    console.log(data);

                });
            });
        });

        $(document).ready(function(){
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    console.log(data);

                });
                // alert(urlEdit);

            });
        });

    </script>

@endsection