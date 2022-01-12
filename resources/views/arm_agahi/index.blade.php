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

    @can('Insert_ArmAgahi')  <!-- Check For Access Permission User --> 
        <a href="{{route('arm_agahi.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن آرم آگهی</a>
    @endcan 

    <br>                                                 
    <br>

    <!-- ST DOC 1400-06 Form For Search --> 
    <form action="{{route('arm_agahi_search')}}" method="get"> 

        <!-- <div class="card" style="width:1800px; max-width:98%; margin-right:10px;"> 
            <div class="card-hearder" style="font-weight:bold; color:gray; margin-right:10px;">جستجو</div> 
                <div class="card-body"> --> 
        <div class="card" style="margin-right:20px; width:1600px; max-width:95%; ">
            <div class="card-header" style="font-weight:bold; color:gray; ">جستجو</div>
            <div class="card-body"> 

                    <div class="row">
                        <div class="col-md" style="left:-10px;"> 
                            <div class="form-group d-flex" > 
                                <label for="myselect">شبکه</label> 
                                <div style="margin-right:10px;"> 
                                    <select name="channel_id" id="myselect" multiple style=" margin-right:30px;"> 
                                        @foreach($channels as $channel)  
                                            <option value="{{$channel->id}}">{{$channel->channel_name}}</option> 
                                        @endforeach 
                                    </select> 
                                </div> 
                            </div> 
                        </div> 

                        <div class="col-md" style="left:-20px;"> 
                            <div class="form-group d-flex"> 
                                <label for="coef" >ضریب</label> 
                                <div> 
                                    <input type="text" id="coef" name="coef" class="form-control" placeholder="ضریب" style="width:100px; margin-right:10px;"> 
                                </div> 
                            </div> 
                        </div> 

                        <div class="col-md-2" style="left:-40px;">
                            <div class="form-group d-flex">
                                <label for="from-date" style="margin-right:-20px;" >از تاریخ</label>
                                <div>
                                    <input data-jdp id="from-date" name="from_date" class="form-control" placeholder="از تاریخ" style="margin-right:10px; width:130px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md" style="left:-10px;"> 
                            <div class="form-group d-flex"> 
                                <label for="to-date">تا تاریخ</label> 
                                <div > 
                                    <input data-jdp name="to_date" id="to-date" class="form-control" placeholder="تا تاریخ" style="margin-right:10px; width:130px;"> 
                                </div> 
                            </div> 
                        </div> 

                        @can('Get_Permission_To_Other_User')  <!-- Check for Access Permission User --> 
                            <div class="col-md" style="left:-25px;">
                                <div class="form-group d-flex" >
                                    <label for="myselect-2">کاربر</label>
                                    <div style="margin-right:10px;">
                                        <select name="user_id" id="myselect-2" multiple style="margin-right:30px; width:200px;">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        <div class="col-md" style="left:-80px;">
                            <div class="form-group">
                                <input type="submit" value="جستجو" class="btn btn-primary">
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>

            <!-- </div>                    
        </div> -->
    </form>
    <!-- END DOC 1400-06 Form For Search --> 

    <!-- <div class="md mx-auto"> -->
    <div class="row"> 
        <div class="col "> 
            <table class="table table-bordered" style="margin-top:10px; max-width:100%; max-height:100px; margin-right:20px; "> 
                <tr style="height:1px;"> 
                    <th style="width:1%; background-color:darkgray; text-align:center; height:1%; ">ردیف</th> 
                    <th style="width:12%; background-color:darkgray; text-align:center; height:1%; ">عنوان شبکه</th> 
                    <th style="width:6%; background-color:darkgray; text-align:center; height:1%; ">ضریب آرم آگهی</th> 
                    <th style="width:6%; background-color:darkgray; text-align:center; height:1%; ">از تاریخ</th> 
                    <th style="width:6%; background-color:darkgray; text-align:center; height:1%; ">تا تاریخ</th> 

                    @can('Get_Permission_To_Other_User') 
                        <th style="width:20%; background-color:darkgray; text-align:center; height:1%; ">کاربر</th> 
                    @endcan 

                    <th style="width:50px; background-color:darkgray; height:1% ">Action</th> 
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

                                @can('Get_Permission_To_Other_User')  <!-- Check For Access Permission User --> 
                                    @foreach($users as $user) 
                                        @if($user->id == $arm->user_id) 
                                            <td style="height:1px;">{{$user->name}}</td> 
                                        @endif 
                                    @endforeach 
                                @endcan 

                                <td class="btn-group" >
                                    @can('Edit_ArmAgahi') <!-- Check For access Permission User --> 
                                        <a href="{{route('arm_agahi.edit', $arm->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan

                                    @can('Delete_ArmAgahi') <!-- Check For Access Permission User --> 
                                        <form class="delete" action="{{route('arm_agahi.destroy' , $arm->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    @endcan 
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>  
        </div>
    </div>

    <!-- </div> -->

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
                                    <input data-jdp name = "from_date" class ="form-control" style = "width:150px;" placeholder = "از تاریخ" >
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
                                    <input type="text" name="coef" id="coefs" class="form-control" placehplder="ضریب آرم آگهی" style="width:100px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input data-jdp name="from_date" id="from-dates" class="form-control" placeholder="از تاریخ" style="width:150px;">
                                </div>
                                <div class="col form-group">
                                    <input data-jdp name="to_date" id="to-dates" class="form-control" placeholder="تا تاریخ" style="width:150px;">
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
                $('#coefs').val(data.coef);
                $('#from-dates').val(data.from_date);
                $('#to-dates').val(data.to_date);
                $('#user-id').val(data.user_id);

                var urlUpdate = '/arm_agahi/' + data.id;
                $('.edit-ArmAgahi').attr('action',urlUpdate);
            });
        });

        // ST DOC 1400-10-05 Alarm Delete For User Before Delete Fiziki By User 
        $('.delete').on('submit' , (e)=>{
            if(!confirm('آیا از حذف اطمینان دارید؟')){
                e.preventDefault();
            }
        })
        // END DOC 1400-10-05 Alarm Delete For User Before Delete Fiziki By User 
 
    });


</script>
<!-- END DOC 1400-07-20 Ajax For Popup Modal -->

@endsection


