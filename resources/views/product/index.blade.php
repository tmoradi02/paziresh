@extends('layouts.app')
@section('content')

    <!-- ST DOC 1400-09-17 پیغام خطا به کاربر -->
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <div class="alert">{{$message}}</div>
            @endforeach
        </div>
    @endif
    <!-- ENd DOC 1400-09-17 پیغام خطا به کاربر -->

    @can('Insert_Product')  <!-- Cehck Access For Permission User --> 
        <a href="{{route('product.create')}}" class="next" data-toggle="modal" data-target="#createModal">اضافه نمودن محصولات</a>
    @endcan

    <br>
    <br>

    <!-- ST DOC 1400-07-20 Form For Search -->
    <form action="{{route('product_search')}}" method="get">
        <div class="card" style="margin-right:15px; margin-left:15px;">
            <div class="card-header" style="font-weight:bold; color:gray;">جستجو</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md">
                            <div class="form-group d-flex">
                                <label for="myselect">صنف</label>
                                <div style="width:300px;">
                                    <select name="cast_id" id="myselect" multiple>
                                        @foreach($casts as $cast)
                                            <option value="{{$cast->id}}">{{$cast->cast}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-group d-flex">
                                <label for="product">محصول</label>
                                <input type="text" name="product" id="product" placeholder="محصول" class="form-control">
                            </div>
                        </div>

                        @can('Get_Permission_To_Other_User')
                        <div class="col-md">
                            <div class="form-group d-flex">
                                <label class="col-3" for="myselect-2" style="margin-right:-20px;">نام کاربر</label>
                                <div style="margin-right:-10px;">
                                    <select name="user_id" id="myselect-2" multiple class="form-control show-user" style="width:300px;">
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endcan

                        <div class="col-md">
                            <div class="form-group d-flex">
                                <input type="submit" value="جستجو" class="btn btn-primary">
                            </div>
                        </div>

                    </div>
                </div>
        </div>            
    </form>
    <!-- END DOC 1400-07-20 Form For Search -->

    <br>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" style="max-width:100%; ">
                <tr style="height:1px;">
                    <th style="width:1% ; background-color:darkgray; text-align:center">ردیف</th>
                    <th style="width:20% ; background-color:darkgray; text-align:center;">عنوان صنف</th>
                    <th style="width:20% ; background-color:darkgray; text-align:cenetr;">عنوان محصول</th>

                    @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                        <th style="width:20% ; background-color: darkgray; text-align: center;">کاربر</th>
                    @endcan

                    <th style="width:50px ; background-color:darkgray; ">Action</th>
                </tr>

                @foreach($casts as $cast)
                    @foreach($products as $product)
                        @if($cast->id == $product->cast_id)
                            <tr class="rowt" style="height:1px;">
                                <td class="rowtt" style="height:1px; text-align:center;"></td>
                                <td style="height:1px;">{{$cast->cast}}</td>
                                <td style="height:1px;">{{$product->product}}</td>

                                @can('Get_Permission_To_Other_User')
                                    @foreach($users as $user)
                                        @if($user->id == $product->user_id)
                                            <td>{{$user->name}}</td>
                                        @endif
                                    @endforeach
                                @endcan

                                <td class="btn-group" style="height:10%;">
                                    @can('Edit_Product')  <!-- Check Access For Permission User --> 
                                        <a href="{{route('product.edit' , $product->id)}}" class="btn btn-warning btn-send-ajax" id="btn-table" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-alt"></i></a>
                                    @endcan

                                    @can('Delete_Product')  <!-- Check Access For Permission User --> 
                                        <form class="delete" action="{{route('product.destroy' , $product->id)}}" method="post">
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

    <!-- ST DOC Modal For From Add -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">اضافه نمودن محصولات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form New Record -->
                    <form action="{{route('product.store')}}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col form-group">
                                    <select name="cast_id" class="form-control show-cast">
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="product" placeholder="عنوان محصول" class="form-control">
                                </div>
                            </div>
                            @can('Get_Permission_To_Other_User')  <!-- Check Access For Permission User --> 
                                <div class="row">
                                    <div class="col form-group">
                                        <select name="user_id" class="form-control show-user">
                                        </select>
                                    </div>
                                </div>
                            @endcan
                            
                            <div class="row">
                                <div class="col form-group">
                                    <input type="submit" value="ثبت" class="btn btn-primary">
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div> 
                                <div class="col"></div> 
                                <div class="col"></div> 
                                <div class="col"></div> 
                                <div class="col"></div> 
                            </div> 
                        </div> 
                    </form> 
                    <!-- Form New Record --> 
                </div> 
            </div> 
        </div> 
    </div> 
    <!-- END DOC Modal For Form Add -->

    <!-- ST DOC Modal For From Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">ویرایش محصولات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ST Add Form For Edit -->
                        <form action="" class="edit-product" method="post">
                            @csrf
                            @method('put')
                            <div class="container">
                                <div class="row">
                                    <div class="col form-group">
                                        <select name="cast_id" id="cast-id" class="form-control show-cast" >

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" name="product" id="products" class="form-control" placeholder="عنوان محصول" >
                                    </div>
                                </div>
                                @can('Get_Permission_To_Other_User')
                                    <div class="row">
                                        <div class="col form-group">
                                            <select name="user_id" id="user-id" class="form-control show-user">

                                            </select>
                                        </div>
                                    </div>
                                @endcan
                                <div class="row">
                                    <div class="col form-group">
                                        <input type="submit" value="ثبت" class="btn btn-primary">
                                    </div>
                                    <div class="col">
                                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col"></div>
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
            $('.btn-send-ajax').click(function(){
                var urlEdit = $(this).attr('href');
                $.ajax({
                    url:urlEdit
                }).done(function(data){
                    // console.log(data);
                    $('#cast-id').val(data.cast_id);
                    $('#products').val(data.product);
                    $('#user-id').val(data.user_id);

                    var urlUpdate = '/product/' + data.id;
                    $('.edit-product').attr('action', urlUpdate);
                })
                // alert(urlEdit);
            });

            // ST DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 
            $('.delete').on('submit' , (e)=>{
                if(!confirm('آیا از حذف اطمینان دارید؟')){
                    e.preventDefault();
                }
            })
            // END DOC 1400-10-06 Alarm Delete For User Before Delete Fiziki By User 

        });


    </script>
@endsection

