@extends('layouts.app')
@section('content')

    <a href="{{route('adver_type_coef.create')}}" class="next" style="margin-right:20px;" data-toggle="modal" data-target="#createModal" >اضافه نمودن ضریب نوع کدآگهی</a>
    <br>                                                                                
    <br>

    <form action="{{route('adver_type_coef_search')}}" mthod="get">
        <label style="padding-right:20px; font-weight:bold; color:gray;">جستجو</label>

        <div class="row" style="border:1px ridge lightblue; padding-right:1px; padding-top:15px; margin-right:20px; width:1350px;">
            <div class="col">
                <div class="form-group">
                    <select name="adver_type_id" id="myselect" multiple style="width:300px;">
                        @foreach($adver_types as $adver_type)
                            <option value="{{$adver_type->id}}">{{$adver_type->adver_type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input type="text" name="coef" placeholder="ضریب عنوان کدآگهی" class="form-control" style="width:180px;">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input data-jdp name="from_date"  placeholder="از تاریخ" class="form-control" style="width:150px;">
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control" style="width:150px;">
                </div>            
            </div>

            <div class="col">
                <div class="form-group">
                    <select name="user_id" id="myselect-2" multiple style="width:320px;">
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
    </form>
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px;  background-color:darkgray; text-align:center;" >ردیف</th>
            <th style="width:50px; background-color:darkgray; text-align:center;" >نوع کدآگهی</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">ضریب نوع کداگهی</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">از تاریخ</th>
            <th style="width:10px; background-color:darkgray; text-align:center;">تا تاریخ</th>
            <th style="width:50px; background-color:darkgray; ">Action</th>
        </tr>

        @foreach($adver_types as $adver_type)
            @foreach($adver_type_coefs as $adver_type_coef)
                @if( $adver_type->id == $adver_type_coef->adver_type_id )
                    <tr class="rowt" style="height:1px;">
                        <td class="rowtt" style="height:1px; text-align:center;"></td>
                        <td style="height:1px;">{{$adver_type->adver_type}}</td>
                        <td style="height:1px; width:10px;">{{$adver_type_coef->coef}}</td>
                        <td style="height:1px;width:10px;">{{$adver_type_coef->from_date}}</td>
                        <td style="height:1px;width:10px;">{{$adver_type_coef->to_date}}</td>
                        <td class="btn-group">
                            @can('Edit_Adver_Type_Coef')
                                <a href="{{route('adver_type_coef.edit' , $adver_type_coef->id)}}" class="btn btn-warning btn-send-ajax" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                            @endcan

                            @can('Delete_Adver_Type_Coef')
                                <form action="{{route('adver_type_coef.destroy' , $adver_type_coef->id)}}" method="post">
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


    <!-- ST DOC 1400-08-26 Modal For Create New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن ضریب نوع کدآگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <!-- ST DOC 1400-08-26 Modal For Create -->
                    <form action="{{route('adver_type_coef.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <select name="adver_type_id" class="form-control show-adverType" >
                                    
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="text" name="coef" class="form-control" placeholder="ضریب">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input data-jdp name="from_date" placeholder="از تاریخ" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" class="form-control show-user" style="width:210px;">
                                        
                                        </select>
                                    </div>
                                @endcan

                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                <!-- END DOC 1400-08-26 Modal For Create -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-26 Modal For Create New Record -->

    <!-- ST DOC 1400-08-26 Modal For Edit -->
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش ضریب نوع کدآگهی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form action="" class="edit-AdverTypeCoef" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <select name="adver_type_id" id="adverType-id" class="form-control show-adverType">
                                    
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="text" name="coef" id="coef" class="form-control" placeholder="ضریب نوع">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input data-jdp name="from_date" id="from-date" class="form-control" placeholder="از تاریخ">
                                </div>
                                <div class="col form-group">
                                    <input data-jdp name="to_date" id="to-date" class="form-control" placeholder="تا تاریخ">
                                </div>
                            </div>
                            <div class="row">
                                @can('Get_Permission_To_Other_User')
                                    <div class="col form-group">
                                        <select name="user_id" id="user-id" class="form-control show-user" style="width:210px;">
                                        
                                        </select>
                                    </div>
                                @endcan
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                                </div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- Edit Form -->

                </div>
            </div>
        </div>
    </div>
    <!-- END DOC 1400-08-26 Modal For Edit -->

    <script>
        $(document).ready(function(){
            $('.btn-send-ajax').click(function(){
                var urlEdit = $(this).attr('href');

                // alert(urlEdit);
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#adverType-id').val(data.adver_type_id);
                    $('#coef').val(data.coef);
                    $('#from-date').val(data.from_date);
                    $('#to-date').val(data.to_date);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/adver_type_coef/' + data.id;
                    $('.edit-AdverTypeCoef').attr('action' , urlUpdate);
                });
            });
        });

    </script>
@endsection 


