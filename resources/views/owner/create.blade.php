@extends('layouts.app')
@section('content')

    @if($errors->any() )
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{route('owner.index')}}" class="previous">لیست صاحب آگهی</a>
    <br>

    <form action="@if($status == 'insert') {{route('owner.store')}}  @else  {{route('owner', $owner->id)}} @endif" method="post">
        @csrf
        @if($status == 'update') @method('put') @endif

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="owner" placeholder="نام صاحب آگهی" maxlength="255" class="form-control" @if($status == 'update') value= "{{$owner->owner}}" @endif>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="manager_owner" placeholder="نام مدیرعامل" maxlength="255" class="form-control" @if($status == 'update') value= "{{$owner->manager_owner}}" @endif>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="email_owner" placeholder="ایمیل" maxlength="50" class="form-control" @if($status == 'update') value= "{{$owner->email_owner}}" @endif>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="tell_owner" placeholder="تلفن" maxlength="30" class="form-control" @if($status == 'update') value= "{{$owner->tell_owner}}" @endif>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="fax_owner" placeholder="فکس" maxlength="30" class="form-control" @if($status == 'update') value= "{{$owner->fax_owner}}" @endif>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="address_owner" placeholder="آدرس" maxlength="255" class="form-control" @if($status == 'update') value= "{{$owner->address_owner}}" @endif>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <input type="text" name="description_owner" placeholder="توضیحات" maxlength="255" class="form-control" @if($status == 'update') value= "{{$owner->description_owner}}" @endif>
                    </div>
                </div> 
            </div>

            <div class="row">
                <div class="col" >
                    <div class="form-group" style="padding-right:30px; flex-direction: row-reverse; " >
                        <input type="radio" name="kind_group" id = "1" value="1"  @if($status == 'update') @if($owner->kind_group == 1) checked  @endif @endif>
                        <label>گروه اول</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group" style="padding-right:30px; flex-direction: row-reverse; >
                        <input type="radio" name="kind_group" id ="2" value="2"  @if($status == 'update') @if($owner->kind_group == 2) checked  @endif @endif>
                        <label>گروه دوم</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group" style="padding-right:30px; flex-direction: row-reverse; " >
                        <input type="radio" name="kind_group" id="3" value="3"  @if($status == 'update') @if($owner->kind_group == 3) checked  @endif @else($status == 'insert') checked @endif>
                        <label>گروه سوم</label>
                    </div>
                </div>

                <div class="col">
                    <select name="user_id" class="form-control" style="width:415px;">
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($status == 'update')  @if($user->id == $owner->user_id) selected @endif @endif>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="submit" value = "ثبت" class = "btn btn-primary" style="border-radius 5px;">
                    </div>
                </div>
            </div>  
        </div>
    </form>
@endsection

