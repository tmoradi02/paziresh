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

    <form action="{{route('user.store')}}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="name" maxlength="30" placeholder="نام کاربر" class="form-control" >
                    </div>
                    <div class="height" style="height:200px ; overflow-y:scroll; padding:30px">
                        @foreach($permissions as $permission)
                            <div class="row">
                                <input type="checkbox" name="prm[]" value = "{{$permission->id}}">
                                <label>{{$permission->permission_name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
  
                <div class="col">
                    <div class="form-group">
                        <input type="email" name="email" maxlength="100" placeholder="ایمیل" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="کلمه عبور" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="tell" maxlength="40" placeholder="تلفن" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="radio" name="status" id="1" value="1" checked class="flat">
                                <label>فعال</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="radio" name="status" id="0" value="0"  class="flat">
                                <label>غیر فعال</label>
                            </div>
                        </div>  
                        <div class="col">

                        </div>  
                        <div class="col">

                        </div>       
                        <div class="col">

                        </div>  
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">ثبت</button>
                    </div>
                </div>
            </div>
                
        </div>
    </form>





@endsection