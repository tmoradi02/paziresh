@extends('layouts.app')
@section('content')

    @if(session()->has('warning'))
        <div class="alert alert-warning">{{session()->get('warning')}}</div>
    @endif

    <a href="{{route('arm_agahi.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن آرم آگهی</a>
    <br>                                                 
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">عنوان شبکه</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">ضریب آرم آگهی</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">از تاریخ</th>
            <th style="width:100px; background-color:darkgray; text-align:center;">تا تاریخ</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">View Log File</th>
            <th style="width:200px; background-color:darkgray;">Action</th>
        </tr>
        @foreach($channels as $channel)
            @foreach($arm_agahies as $arm)
                @if($channel->id == $arm->channel_id)
                    <tr class="rowt" style="height:1px;">
                        <td class="rowtt" style="height:1px; text-align:center;"></td>
                        <td style="height:1px;">{{$channel->channel_name}}</td>
                        <td style="height:1px;">{{$arm->coef}}</td>
                        <td style="height:1px;">{{$arm->from_date}}</td>
                        <td style="height:1px;">{{$arm->to_date}}</td>

                        @foreach($users as $user)
                            @if($user->id == $arm->user_id)
                                <td>{{$user->name}}</td>
                            @endif
                        @endforeach

                        <td class="btn-group" >
                            @can('Edit_ArmAgahi')
                                <a href="{{route('arm_agahi.edit', $arm->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @can('Delete_ArmAgahi')
                            <form action="{{route('arm_agahi.destroy' , $arm->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>  

    <form action="{{route('arm_agahi_search')}}" method="get">  
        <!-- <div class="container"> -->
            <label style="font-weight:bold; color:gray; margin-right:20px;">جستجو</label>
            <div style="width: fit-content">
            <div class="row" style="border:1px ridge lightblue; height:70px; margin-right:10px; padding:15px;">

                <div class="col" >
                    <div class="form-group" style="width:300px;">
                        <select name="channel_id" id="myselect" multiple>
                            @foreach($channels as $channel)
                                <option value="{{$channel->id}}">{{$channel->channel_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="text" name="coef" class="form-control" placeholder="ضریب">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="from_date" placeholder="از تاریخ" class="form-control" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control" />
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="width:300px;">
                        <select name="user_id" id="myselect-2" multiple>
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
        <!-- </div> -->
    </form>

    <!-- ST DOC 1400-08-24 Modal For New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن آرم آگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Form Create -->
                    <form action="{{route('arm_agahi.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <select name="channel_id" class="form-control show-channel" style="width:200px;">
                                    </select>
                                </div>

                                <div class="col form-group">
                                    <input type="text" name="coef" placeholder= "ضریب شبکه" class="form-control" style="width:150px;"> 
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col form-group"> 
                                    <input data-jdp name="from_date" class="form-control" style="width:200px;" placeholder="از تاریخ" >
                                </div>

                                <div class="col form-group"> 
                                    <input data-jdp name="to_date" class="form-control" style="width:200px;" placeholder="تا تاریخ" >
                                </div>

                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" class="form-control show-user" style="width:200px;">

                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>

                                <div class="col form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>       
                            </div>

                        </div>
                    </form>
                    <!-- END DOC From Create -->

                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-27 Modal For New Record -->

<!-- ST Modal For Edit Form 1400-07-20 -->
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

                    <!-- ST Edit Form -->
                    <form action="" class="Edit-armagahi" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <select name="channel_id" id="channel-id" class="form-control show-channel">
                                    </select>
                                </div>
                                <div class="col form-group">                                
                                    <input type="text" name="coef" id="coef" placeholder="ضریب شبکه" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input data-jdp name="from_date" id="from-date" placeholder="از تاریخ" class="form-control" >
                                </div>
                                <div class="col form-group">
                                    <input data-jdp name="to_date" id="to-date" placeholder="تا تاریخ" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" id="user-id" class="form-control show-user" style="width:210px;">
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Edit Form -->

                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
<!-- END Modal For Edit Form 1400-07-20 -->

<!-- ST DOC 1400-07-20 Ajax For Popup Modal -->
<script>
    $(document).ready(function(){
        $('.btn-send-ajax').click(function(e)
        {
            e.preventDefault();
            var urlEdit = $(this).attr('href');
                // alert(urlEdit);
            $.ajax
                ({
                    url:urlEdit
                }).done(function(data)
            {
                // alert('hi');
                console.log(data); 
                $('#channel-id').val(data.channel_id);
                $('#coef').val(data.coef);
                $('#from-date').val(data.from_date);
                $('#to-date').val(data.to_date);
                $('#user-id').val(data.user_id);

                var urlUpdate = '/arm_agahi/' + data.arm_agahi.id;
                console.log(urlUpdate);

                // alert('hi');
                $('.Edit-armagahi').attr('action' , urlUpdate);

                // var route = '/arm_agahi/' + data.arm_agahi.id;
                // $('.edit-armagahi').attr('action', route);
            });
        });
    });

</script>
<!-- END DOC 1400-07-20 Ajax For Popup Modal -->

@endsection


