@extends('layouts.app')
@section('content')

    <a href="{{route('classes.create')}}" class="next">اضافه نمودن طبقه</a>
    <br>
    <br>
    
    <form action="{{route('classes_search')}}" method="get">
        <label style="margin-right:30px; font-weight:bold; color:gray;">جستجو</label>
        <div style="margin-right:30px;">
            <div class="row" style="border:1px ridge lightblue;width:430px;padding:15px 0px; height:70px;">

                <div class="col" >
                    <div class="form-group" style="width:300px;">
                        <input type="text" name="class_name" placeholder="جستجو عنوان طبقه" class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group" style="">
                        <input type="submit" value="جستجو" class="btn btn-primary">
                    </div>
                </div>

            </div>
        </div>
    </form>

    <br>

    <table class="table table-bordered" style="margin-right:20px; margin-left: 30px;">
        <tr style="height:1px;">
            <th style="width:30px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:300px; background-color:darkgray; text-align:center;">عنوان طبقه</th>
            <th style="width:300px; background-color:darkgray; ">action</th>
        </tr>
        @foreach($classes as $classe)
            <tr class="rowt" style="height: 1px;">
                <td class="rowtt" style="height: 1px; text-align:center;"></td>
                <td class="height:1px;">{{$classe->class_name}}</td>
                <td class="btn-group" style="height: 1px;">
                    @can('Edit_Classes')
                        <a href="{{route('classes.edit', $classe->id )}}" class="btn btn-warning bnt-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Classes')
                        <form action="{{route('classes.destroy' , $classe->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش طبقه</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="Edit-classes" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="class_name" id="class-name" placeholder="عنوان طبقه" class="form-control">
                                </div>
                                <div class="col form-group">
                                    <select name="user_id" id="user-id" class="form-control show-user">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.bnt-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                // alert(urlEdit);
                $.ajax({
                    url:urlEdit
                    }).done(function(data){
                    //    console.log(data) ;
                        $('#class-name').val(data.class_name);
                        $('#user-id').val(data.user_id);

                        var urlEdit = '/classes/' + data.id;
                        $('.Edit-classes').attr('action' , urlEdit);
                });
            });
        });
    </script>
@endsection


