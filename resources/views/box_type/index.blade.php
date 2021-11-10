@extends('layouts.app')
@section('content')

    <a href="{{route('box_type.create')}}" class="next">اضافه نمودن محل پخش</a>
    <br>
    <br>

    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">نوع باکس</th>
            <th style="width:200px; background-color:darkgray; ">Action</th>
        </tr>

        @foreach($box_types as $box_type)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$box_type->box_type}}</td>
                <td class="btn-group">
                    @can('Edit_Box_Type')
                        <a href="{{route('box_type.edit' , $box_type->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target = "#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Box_Type')
                        <form action="{{route('box_type.destroy' , $box_type->id)}}" method="post">
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
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش محل پخش</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                    <form action="" class="edit-box-type" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="box_type" id="box-type" class="form-control " placeholder="عنوان محل پخش">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" id="user-id" class="form-control show-user">
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Add Form For Edit -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function(){
        //     $('.btn-send-json').click(function(){
        //         var urlEdit = $(this).attr('href');
        //         $.ajax({
        //             url:urlEdit
        //         }).done(function(data){
        //             console.log(data);
        //         });

        //         // alert(urlEdit);
        //     });

        // });

        $(document).ready(function(){
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#box-type').val(data.box_type);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/box_type/' + data.id;
                    $('.edit-box-type').attr('action' , urlUpdate);
                });
                // alert(urlEdit);
            });
        });
    </script>
@endsection



