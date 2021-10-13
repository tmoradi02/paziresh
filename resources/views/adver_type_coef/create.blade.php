@extends('layouts.app')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{route('adver_type_coef.index')}}" class="previous"> لیست ضریب نوع کدآگهی  &raquo;</a>
    <br>
    
    <form action="@if ($status == 'insert') {{route('adver_type_coef.store')}} @else {{route('adver_type_coef' , $adver_type_coef->id)}} @endif" method ="post">
        @csrf
        @if($status == 'update') @method('put') @endif
        <div class="container">
            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <select name="adver_type_id" id="myselect" multiple class="form-control" style="width:225px;">
                            @foreach($adver_types as $adver_type)
                                <option value="{{$adver_type->id}}" @if($status == 'update') @if($adver_type->id == $adver_type_coef->adver_type_id) selected @endif @endif  >{{$adver_type->adver_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="text" name="coef" placeholder="ضریب نوع کدآگهی" @if($status == 'update') value="{{$adver_type_coef->coef}}" @endif class="form-control">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input data-jdp name="from_date" placeholder="از تاریخ" class="form-control" @if($status == 'update') value="{{$adver_type_coef->from_date}}" @endif />
                    </div>
                </div>

                <div class="col">
                    <form-group>
                        <input data-jdp name="to_date" placeholder="تا تاریخ" class="form-control" @if($status == 'update') value="{{$adver_type_coef->to_date}}" @endif/>
                    </form-group>
                </div>

                <div class="col">
                    <div class="form-group">
                        @can('Get_Permission_To_Other_User')
                            <select name="user_id" id="myselect-2" multiple class="form-control" style="width:225px;">
                                @foreach($users as $user) 
                                    <option value="{{$user->id}}" @if($status == 'update') @if($user->id == $adver_type_coef->user_id) selected @endif @endif  >{{$user->name}}  </option>
                                @endforeach
                            </select>
                        @endcan
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary">ثبت</button>
                    </div>
                </div> 
                
            </div>
        </div>
    </form>

@endsection

