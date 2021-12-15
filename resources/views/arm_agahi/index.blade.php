@extends('layouts.app')
@section('content')

    <!-- @if(session()->has('warning'))
        <div class="alert alert-warning">{{session()->get('warning')}}</div>
    @endif -->

    <!-- ST DOC 1400-09-17 پیغام دادن به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-17 پیغام دادن به کاربر -->

    @can('Insert_ArmAgahi')
        <a href="{{route('arm_agahi.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن آرم آگهی</a>
    @endcan

    <br>                                                 
    <br>

    <!-- ST DOC 1400-06 Form For Search -->
    <form action="{{route('arm_agahi_search')}}" method="get">
        <label style="font-weight:bold; color:gray; margin-right:20px;">جستجو</label>
        <div style="width:fit-content">

            @can('Get_Permission_To_Other_User')
                <div class="row" style="border:1px ridge lightblue; height:70px; margin-right:10px; padding:15px; width:1300px;"> 
            @else
                <div class="row" style="border:1px ridge lightblue; height:70px; margin-right:10px; padding:15px; width:1100px;"> 
            @endif

                <div class="col">
                    <div class="form-group" style="width:300px;"> 
                        <select name="channel_id" id="myselect" multiple> 
                            @foreach($channels as $channel) 
                                <option value="{{$channel->id}}">{{$channel->channel_name}}</option>
                            @endforeach
                        </select> 
                    </div>
                </div>

                <div class="col form-group">
                    <input type="text" name="coef" class="form-control" placeholder="ضریب">
                </div>

                <div class="col form-group">
                    <input data-jdp name="from_date" class="form-control" placeholder="از تاریخ">
                </div>

                <div class="col form-group">
                    <input data-jdp name="to_date" class="form-control" placeholder="تا تاریخ">
                </div>

                @can('Get_Permission_To_Other_User')
                    <div class="col">
                        <div class="form-group" style="width:350px;">
                            <select name="user_id" id="myselect-2" multiple class="form-control">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endcan

                <div class="col form-group">
                    <input type="submit" value="جستجو" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
    <!-- END DOC 1400-06 Form For Search -->

    <table class="table table-bordered" style="margin-top:10px;">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center; height:1px;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center; height:1px;">عنوان شبکه</th>
            <th style="width:100px; background-color:darkgray; text-align:center; height:1px;">ضریب آرم آگهی</th>
            <th style="width:100px; background-color:darkgray; text-align:center; height:1px;">از تاریخ</th>
            <th style="width:100px; background-color:darkgray; text-align:center; height:1px;">تا تاریخ</th>

            @can('Get_Permission_To_Other_User')
                <th style="width:200px; background-color:darkgray; text-align:center; height:1px;">کاربر</th>
            @endcan

            <th style="width:200px; background-color:darkgray; height:1px;">Action</th>
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

                        @can('Get_Permission_To_Other_User')
                            @foreach($users as $user)
                                @if($user->id == $arm->user_id)
                                    <td style="height:1px;">{{$user->name}}</td>
                                @endif
                            @endforeach
                        @endcan

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
                                    <select name="channel_id" class = "form-control show-channel" style = "width:200px;">
                                    </select>
                                </div>

                                <div class="col form-group">
                                    <input type="text" name = "coef" placeholder = "ضریب شبکه" class = "form-control" style = "width:150px;"> 
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col form-group"> 
                                    <input data-jdp name = "from_date" class ="form-control" style = "width:200px;" placeholder = "از تاریخ">
                                </div>

                                <div class="col form-group"> 
                                    <input data-jdp name = "to_date" class = "form-control" style = "width:150px;" placeholder = "تا تاریخ" >
                                </div>

                            </div>

                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name = "user_id" class = "form-control show-user" style = "width:200px;">

                                        </select>
                                    </div>
                                @endcan
                                
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

    <!-- ST DOC 1400-08-29 Modal For Edit Form -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش آرم آگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Edit Form -->
                    <form action="" class="edit-ArmAgahi" method="post">
                        @csrf
                        @method('put')

                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <select name="channel_id" id="channel-id" class="form-control show-channel">
                                    
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="text" name="coef" id="coef" class="form-control" placehplder="ضریب آرم آگهی" style="width:100px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input data-jdp name="from_date" id="from-date" class="form-control" placeholder="از تاریخ" style="width:150px;">
                                </div>
                                <div class="col form-group">
                                    <input data-jdp name="to_date" id="to-date" class="form-control" placeholder="تا تاریخ" style="width:150px;">
                                </div>
                            </div>

                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" id="user-id" class="form-control show-user" style="width:210px;">
                                        
                                        </select>
                                    </div>
                                @endcan

                                <div class="col">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC Edit Form -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- END DOC 1400-08-29 Modal For Edit Form -->


<!-- ST DOC 1400-07-20 Ajax For Popup Modal -->
<script>
    $(document).ready(function(){
        $('.btn-send-ajax').click(function(){
            var urlEdit = $(this).attr('href');
            // alert(urlEdit);
            $.ajax({
                url:urlEdit
            }).done(function(data){
                console.log(data);
                $('#channel-id').val(data.channel_id);
                $('#coef').val(data.coef);
                $('#from-date').val(data.from_date);
                $('#to-date').val(data.to_date);
                $('#user-id').val(data.user_id);

                var urlUpdate = '/arm_agahi/' + data.id;
                $('.edit-ArmAgahi').attr('action',urlUpdate);
            });
        });
    });

</script>
<!-- END DOC 1400-07-20 Ajax For Popup Modal -->

@endsection


