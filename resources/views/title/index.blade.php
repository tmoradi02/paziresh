@extends('layouts.app')
@section('content')

    <a href="{{route('title.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن عنوان باکس</a>
    <br>
    <br>
    
    <table class="table table-bordered">
        <tr style="height:1px;">
            <th style="width:1px; background-color:darkgray; text-align:center;">ردیف</th>
            <th style="width:200px; background-color:darkgray; text-align:center;">عنوان باکس</th>
            <th style="width:200px; background-color:darkgray; ">Action</th>
        </tr>
        @foreach($titles as $title)
            <tr class="rowt" style="height:1px;">
                <td class="rowtt" style="height:1px; text-align:center;"></td>
                <td style="height:1px;">{{$title->title}}</td>
                <td class="btn-group">
                    @can('Edit_Title')
                        <a href="{{route('title.edit' , $title->id)}}" class="btn btn-warning btn-send-json" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-alt"></i></a>
                    @endcan

                    @can('Delete_Title')
                    <form action="{{route('title.destroy' , $title->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    <!-- ST DOC Modal Form For New Record -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن عنوان باکس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC 1400-08-30 Modal Form For New Record -->
                    <form action="{{route('title.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="title" placeholder="عنوان باکس" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select name="user_id" class="form-control show-user" >
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC 1400-08-30 Modal Form For New Record -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- END DOC Modal Form For New Record -->

    <!-- ST DOC Modal Form For Edit -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش عنوان باکس</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST DOC Add Form For Edit -->
                    <form action="" class = "edit-title" method="post">
                        @csrf
                        @method('put')
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="عنوان باکس">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <select name="user_id" id="user-id" class="form-control show-user" style="width:270px;">
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <button type="button" data-dismiss = "modal" class="btn btn-secondary">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END DOC Add Form For Edit -->
                </div>
            </div>
        </div>
    </div>
    <!-- END DOC Modal Form For Edit -->

    <script>
        $(document).ready(function(){
            $('.btn-send-json').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    $('#title').val(data.title);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/title/' + data.id;
                    $('.edit-title').attr('action', urlUpdate);
                });
            });
        });
    </script>

@endsection
