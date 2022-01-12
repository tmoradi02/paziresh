@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-20 پیغام خطا به کاربر  -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- END DOC 1400-09-20 پیغام خطا به کاربر  -->

    @can('Insert_Tariff')
        <a href="{{route('tariff.create')}}" data-toggle="modal" data-target="#createModal" class="next">اضافه نمودن تعرفه</a>
    @endcan

    <br>
    <br>

    <!-- ST DOC 1400-09-22 جستجوی تعرفه -->
    <form action="{{route('tariff_search')}}" method="get">
        <!-- <label style="padding-right:20px; font-weight:bold; color:gray; padding-right:25px;">جستجو</label>  -->

        <!-- <div class="row" style="border:1px ridge lightblue; padding-right:20px; padding-top:15px; margin-right:20px; width:1850px; max-width:100%;"> -->
        <div class="card" style="max-width:98%; margin-right:10px; ">
            <div class="card-header" style="font-weight:bold; color:gray;">جستجو</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="form-group d-flex">
                            <label for="myselect">شبکه</label>
                            <div>
                                <select name="channel_id" id="myselect" multiple class="form-control" style="width:200px;">
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}">{{$channel->channel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md"> 
                        <div class="form-group d-flex"> 
                            <label for="myselect-2">طبقه</label> 
                            <div>
                                <select name="classes_id" id="myselect-2" multiple class="form-control" style="width:200px;"> 
                                    @foreach($classes as $class) 
                                        <option value="{{$class->id}}">{{$class->class_name}}</option> 
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-group d-flex">
                            <label for="myselect-3" class="col-5">نوع باکس</label>
                            <div style="margin-right:-22px;">
                                <select name="box_type_id" id="myselect-3" multiple class="form-control" style="width:200px;">
                                    @foreach($box_types as $boxType)
                                        <option value="{{$boxType->id}}">{{$boxType->box_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group d-flex">
                            <label for="from-date" class="col-4" style="margin-right:50px;">از تاریخ</label>
                            <div >
                                <input type="text" data-jdp id="from-date" name="from_date" class="form-control" placeholder="از تاریخ" style="width:140px; margin-right:-15px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group d-flex">
                            <label for="to-date" class="col-4" style="margin-right:50px;">تا تاریخ</label>
                            <div>
                                <input type="text" data-jdp id="to-date" name="to_date" class="form-control" placeholder="تا تاریخ" style="width:140px; margin-right:-18px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group d-flex">
                        <label for="prices"  class="col-5">مبلغ تعرفه</label>
                            <input type="text" name="price" id="prices" placeholder="مبلغ تعرفه" class="form-control" style="width:170px; margin-right:-20px;">
                        </div>
                    </div>

                </div>

                <div class="row">
                    @can('Get_Permission_To_Other_User')
                        <div class="col-md">
                            <div class="form-group d-flex" >
                                <label for="myselect-4">کاربر</label>
                                <div>
                                    <select name="user_id" id="myselect-4" multiple>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endcan

                    <div class="col-md">
                        <div class="form-group" >
                            <input type="submit" value="Search" class="btn btn-primary" style="margin-right:120px;">
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
    <!-- END DOC 1400-09-22  -->

    <table class="table table-bordered" style="margin-top:10px; max-width:98%; margin-right:10px; ">
        <tr style="height:1px;">
            <th style="width:1% ; background-color:darkgray ; text-align:center ; ">ردیف</th>
            <th style="width:15% ; background-color:darkgray ; text-align:center ; ">شبکه</th>
            <th style="width:6% ; background-color:darkgray ; text-align:center ; ">طبقه</th>
            <th style="width:10% ; background-color:darkgray ; text-align:center ; ">نوع باکس</th>
            <th style="width:6% ; background-color:darkgray ; text-align:center ; ">از تاریخ</th>
            <th style="width:6% ; background-color:darkgray ; text-align:center ; ">تا تاریخ</th>
            <th style="width:9% ; background-color:darkgray ; text-align:center ; ">مبلغ</th>

            @can('Get_Permission_To_Other_User')
                <th style="width:15% ; background-color:darkgray; text-align:center;">کاربر</th>
            @endcan
            
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
                        <td style="height:10%;">{{number_format($tariff->price)}}</td>

                        @can('Get_Permission_To_Other_User')
                            @foreach($users as $user)
                                @if($user->id == $tariff->user_id)
                                    <td style="height:10%;">{{$user->name}}</td>
                                @endif
                            @endforeach
                        @endcan

                        <td class="btn-group" style="height:10%;">
                            @can('Edit_Tariff')
                                <a href="{{route('tariff.edit' , $tariff->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt" style="height:10%;"></i></a>
                            @endcan

                            @can('Delete_Tariff')
                                <form class="delete" action="{{route('tariff.destroy' , $tariff->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" id="btn-table"><i class="fa fa-trash-alt" style="height:10%;"></i></button>
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
                                        <select name="channel_id" id="channel-id" class="form-control show-channel" >
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
                                        <input type="text" name="price" id="price-new" class="form-control" placeholder ="مبلغ تعرفه">
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
                                @can('Get_Permission_To_Other_User')
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="user_id" id="user-id" class="form-control show-user" style="width:210px;">
                                            </select>
                                        </div>
                                    </div>
                                @endcan
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
                                        <select name="box_type_id" id="boxTyps-id" class="form-control show-boxType">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="price" id="pricess" class="form-control" placeholder="مبلغ"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp class="form-control" name="from_date" id="from-dates">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" autocomplete="off" data-jdp class="form-control" name="to_date" id="to-dates">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col">
                                        <div class="form-group">
                                            <select name="user_id" id="users-id" class="form-control show-user" style="width:210px;">
                                            </select>
                                        </div>
                                    </div>
                                @endcan
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
            </div> 
        </div> 
    </div> 
    <!-- END DOC 1400-09-13 Modla form For Edit Record -->
    
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
                    $('#boxTyps-id').val(data.box_type_id);
                    $('#from-dates').val(data.from_date);
                    $('#to-dates').val(data.to_date);

                    // $('#pric').val(new Intl.NumberFormat().format(data.price));
                    $('#pricess').val(new Intl.NumberFormat().format(data.price));
                    console.log(new Intl.NumberFormat().format(data.price));

                    $('#users-id').val(data.user_id);

                    var urlUpdate = '/tariff/' + data.id; 
                    $('.edit-tariff').attr('action' , urlUpdate); 
                }); 
            }); 

            // ST DOC 1400-10-06 For Edit Price 
            new Cleave(document.getElementById('pricess'), { 
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            })

            // ST DOC 1400-10-06 For New Record Price 
            new Cleave(document.getElementById('price-new'),{
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            })

            // ST DOC 1400-10-20 For Seach Price With Seprator
            new Cleave(document.getElementById('prices'),{
                numeral:true ,
                numeralThousandsGroupStyle: 'thousand'
            })

            // ST DOC 1400-10-05 Allarm Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e) => {
                if(!confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
            // END DOC 1400-10-05 Allarm Delete For User Before Delete Fiziki By User 
        }); 

        // ST DOC 1400-10-05 For Convert Number Price
        function filterInt(value) {
            if (/^[-+]?(\d+|Infinity)$/.test(value)) {
                return Number(value)
            } else {
                return NaN
            }
        }
        // END DOC 1400-10-05 For Convert Number Price
        
    </script>

@endsection 