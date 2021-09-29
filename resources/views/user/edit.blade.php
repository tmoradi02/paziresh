@extends('layouts.app')
@section('content')

    @if($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('user.update',$user->id)}}" method="post">
        @csrf
        @method('put')
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="name" maxlength="30" placeholder="نام کاربر" class="form-control" value="{{$user->name}}">
                    </div>

                    <div class="height" style="height:220px; overflow-y:scroll ; padding:30px;">
                        @foreach($permissions as $permission)
                            <div class="row">
                                @foreach($user->roles() as $role)
                                    <input type="checkbox" name="prm[]" value="{{$permission->id}}" @if($user->roles->pluck('id')->contains($permission->id)) checked @endif>
                                    <label>{{$permission->permission_name}}</label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group">
                        <input type="email" name="email" maxlength="100" placeholder="ایمیل" class="form-control" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="کلمه عبور" class="form-control" >
                    </div>
                    
                    <div class="form-group">
                        <input type="tel" name="tell" maxlength="40" placeholder="تلفن" class="form-control" value="{{$user->tell}}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="radio" name="status" id="1" value="1" class="flat" @if($user->status == "1") checked  @endif>
                                <label>فعال</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="radio" name="status" id="0" value="0" class="flat" @if($user->status == "0") checked   @endif>
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
                        <input type="submit" name="submit" value="ثبت" class="btn btn-primary" >
                    </div>
            </div>
        </div>
    </form>

@endsection