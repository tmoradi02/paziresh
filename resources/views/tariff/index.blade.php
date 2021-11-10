@extends('layouts.app')
@section('content')

    <a href="{{route('tariff.create')}}" class="next">اضافه نمودن تعرفه</a>
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
                                <a href="{{route('tariff.edit' , $tariff->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt" style="height:10%;"></i></a>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش تعرفه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC 1400-08-19 Add Form For Edit -->
                    <form action="" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    
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

    <script>
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