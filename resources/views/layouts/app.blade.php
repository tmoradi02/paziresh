<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl"> <!-- dir="rtl" خودم اضافه کردم -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token() }}">

<!-- ST DOC 1400-07-14  اضافه نمودن رنگ به ضمینه گرید برای یک در میان کردن رنگ رکوردها  --> 
<!-- odd For Zoj - even For Fard -->
    <style>
        table.table.table-bordered tr:nth-child(odd)   
        {
            background-color: lightgray;
        }
    </style>
<!-- END DOC 1400-07-14  اضافه نمودن رنگ به ضمینه گرید برای یک در میان کردن رنگ رکوردها  --> 

    <!-- ST DOC 1400-06-21 Add For Select 2  -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <!-- END DOC 1400-06-21 Add For Select 2  -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- ST 1400-06-6 Persian Date -->
    <script src="/jalalidatepicker.min.js"></script>
    <link rel="stylesheet" href="/jalalidatepicker.min.css" />

    <!-- Styles -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles ST DOC 1400-06-13   اضافه نمودن این سی اس اس برای ساختن نوبار برای منوی اصلی برنامه می باشد -->
    <link href="{{ asset('css/style_me.css') }}" rel="stylesheet">

    <!-- <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- ST DOC 1400-06-27 Add For Table Grid Design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- END DOC 1400-06-27 Add For Table  -->

    <!-- ST DOC 1400-06-27 Add For Icon For Design -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- END DOC 1400-06-27 Add For Icon For Design  -->
    
    <!-- ST DOC 1400-08-08 Script For data of User Table in all Project -->
    <script> 
    // get Users 
        $(document).ready(function(){
            $.ajax({ 
                    url: '/get-users-json'
                }).done(function(data){
                // console.log(data);
                var opts = [];
                for(var user of data)
                {
                    var opt = document.createElement('option');
                    opt.innerHTML = user.name;
                    opt.value = user.id;

                    opts.push(opt);
                }
                $('.show-user').append(opts);
            })

            // get-casts  
            $.ajax({
                url: '/get-casts-json'
            }).done(function(data){
                var opts =[];
                for(var cast of data)
                {
                    var opt = document.createElement('option');
                    opt.innerHTML = cast.cast;
                    opt.value = cast.id;

                    opts.push(opt);
                }
                $('.show-cast').append(opts);
            });

        // });
            $.ajax({
                url:'/get-channels-json'
            }).done(function(data){
                var opts = [];
                for(var ch of data)
                {
                    var opt = document.createElement('option');

                    opt.innerHTML = ch.channel_name;
                    opt.value = ch.id;

                    opts.push(opt);
                }
                $('.show-channel').append(opts);
            })


        });

        $(document).ready(function(){
            $.ajax({
                url:'/get-adverType-json'
            }).done(function(data){
                var opts = [];
                for(var adverType of data)
                {
                    var opt = document.createElement('option');
                    opt.innerHTML = adverType.adver_type;
                    opt.value = adverType.id;

                    opts.push(opt);
                }
                $('.show-adverType').append(opts);
            });
        });
    </script>
    <!-- END DOC 1400-08-08 Script For data of User Table in all Project -->

</head>
<body>
    <div id="app" dir="rtl" ;> <!-- ST DOC 1400-06-01 dir="rtl" خودم اضافه کردم -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height:150px; "> <!-- ST DOC 1400-06-15 ADD Style T.M -->

            <div class="container" > 

                <!--  ST LOCK 1400-06-14              
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                  END LOCK 1400-06-14  -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color:#333; width:100% "> <!-- ST DOC 1400-06-15 ADD Style T.M -->
                    <!-- Left Side Of Navbar -->
                    <!-- ST LOCK 1400-06-14 
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    END LOCK 1400-06-14  -->

                    <!-- Right Side Of Navbar -->  <!-- ST DOC 1400-06-14 اضافه نمودن استایل به منوبار یا همان نوبار -->
                    <ul class="navbar-nav ml-auto" style="top:0; left:500px ; width: 100% ;"> <!-- ST DOC 1400-06-15 ADD Style T.M   (height:50px ; نیازی نبود)  -->
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item" >
                                <a style="color:white; font-size:14px;" class="nav-link" href="{{ route('login') }}">{{ __('لاگین') }}</a> <!-- ST DOC 1400-06-17 ADD Style:Color & Font-Style  -->
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="color:white; font-size:14px;" class="nav-link" href="{{ route('register') }}">{{ __('ثبت نام') }}</a> <!-- ST DOC 1400-06-17 ADD Style:Color & Font-Style  -->
                                </li>
                            @endif
                        @else

                            <!--  ST LOCK 1400-06-20  
                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white; top:300px;">   ST DOC 1400-06-15 ADD Style T.M 
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:rgb(4, 165, 165); top:0px; color:white">   ST DOC 1400-06-15 ADD Style T.M 
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('خروج') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            END LOCK 1400-06-20   -->

                        @endguest

                        @auth

                            <!--  ST DOC 1400-06-14 اضافه نمودن استایل به منوبار یا همان نوبار -- The navigation menu  -->
                            <div class="slide-down-page" >  <!-- ST DOC 1400-06-15 باعث شد نوبار باریک و شکیل تر شود  -->
                            <!-- <div class="navbar" style="width:100%;">   ST LOCK 1400-06-15 ADD Style T.M   style="width:100%;" -->

                                <div class="subnav" >
                                    <button class="subnavbtn">اطلاعات پایه<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">

                                        <a href="{{route('channel.index')}}" >لیست شبکه</a>
                                        <!-- <a href="{{route('channel.create')}}">اضافه نمودن شبکه</a> -->
                                        
                                        <a href="{{route('classes.index')}}" >لیست طبقه</a>
                                        <!-- <a href="{{route('classes.create')}}" >اضافه نمودن طبقه</a> -->

                                        <a href="{{route('cast.index')}}" >لیست اصناف</a>
                                        <!-- <a href="{{route('cast.create')}}" >اضافه نمودن اصناف</a> -->

                                        <a href="{{route('product.index')}}">لیست محصولات</a>
                                        <!-- <a href="{{route('product.create')}}">اضافه نمودن محصولات</a> -->

                                        <a href="{{route('arm_agahi.index')}}">لیست آرم آگهی</a>
                                        <!-- <a href="{{route('arm_agahi.create')}}">اضافه نمودن آرم آگهی</a> -->

                                        <a href="{{route('box_prog_group.index')}}">لیست گروه برنامه</a>
                                        <!-- <a href="{{route('box_prog_group.create')}}">اضافه نمودن گروه برنامه</a> -->

                                    </div>
                                </div>
                            
                                <div class="subnav">
                                    <button class="subnavbtn">آگهی ها<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">
                                        <a href="{{route('owner.index')}}">لیست صاحب آگهی</a>
                                        <!-- <a href="{{route('owner.create')}}">اضافه نمودن صاحب آگهی</a> -->
                                    </div>
                                </div>

                                <div class="subnav">
                                    <button class="subnavbtn">کنداکتور<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">
                                        <a href="#bring">تنظیم برنامه روزانه</a>
                                        <a href="#deliver">کپی برنامه روزانه</a>
                                        <a href="#package">حذف برنامه روزانه</a>
                                        <a href="#express">جستجوی برنامه روزانه</a>
                                    </div>
                                </div>

                                <div class="subnav">
                                    <button class="subnavbtn">تعرفه<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">
                                        <a href="{{route('tariff.index')}}">لیست تعرفه</a>
                                        <a href="#link2">کپی تعرفه</a>
                                    </div>
                                </div>
                            
                                <div class="subnav">
                                    <button class="subnavbtn">پذیرش<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">
                                        <a href="">پذیرش</a>
                                        <a href="">جستجوی کلی</a>
                                    </div>
                                </div>

                                <div class="subnav">
                                    <button class="subnavbtn">Admin<i class="fa fa-caret-down"></i></button>
                                    <div class="subnav-content">
                                        @can('Get_Permission_To_Other_User')
                                            <a href="{{route('user.index')}}">لیست کابران</a>
                                            <!-- <a href="{{route('user.create')}}">اضافه نمودن کاربر</a> -->
                                        @endcan
                                        
                                        <a href="{{route('box_type.index')}}">لیست محل پخش - نوع باکس</a>
                                        <!-- <a href="{{route('box_type.create')}}">اضافه نمودن محل پخش</a> -->

                                        <a href="{{route('title.index')}}">لیست عنوان باکس</a>
                                        <!-- <a href="{{route('title.create')}}">اضافه نمودن عنوان باکس</a> -->
                                        <!-- این جدول برای محاسبه محل پخش آگهی (اولین آگهی و...) اضافه گردید   -->

                                        <a href="{{route('adver_type.index')}}">لیست نوع کدآگهی</a>
                                        <!-- <a href="{{route('adver_type.create')}}">اضافه نمودن نوع کدآگهی</a> -->

                                        <a href="{{route('adver_type_coef.index')}}">لیست ضریب نوع کدآگهی</a>
                                        <!-- <a href="{{route('adver_type_coef.create')}}">اضافه نمودن ضریب نوع کدآگهی</a> -->
                                    </div>
                                </div>

                                    <div class="subnav" >
                                        <a class="dropdown-item" href="{{ route('logout') }} " style="font-size:16px;"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('خروج') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                  
                            </div>



                            <!-- ST DOC 1400-06-15 اضافه نمودن منوبار  -->
                            <!-- <ul id="nav">
                                <li><a href="#">اطلاعات پایه</a>
                                <ul>
                                    <li><a href="#">Sub Item</a></li>
                                    <li><a href="#">Sub Item</a></li>

                                    <li><a href="#">شبکه »</a>
                                    <ul>
                                        <li><a href="{{route('channel.index')}}">لیست شبکه</a>
                                        <li><a href="{{route('channel.create')}}">اضافه نمودن شبکه</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">طبقه »</a>
                                    <ul>
                                        <li><a href="{{route('classes.index')}}">لیست طبقه</a>
                                        <li><a href="{{route('classes.create')}}">اضافه نمودن طبقه</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">صنف »</a>
                                    <ul>
                                        <li><a href="{{route('cast.index')}}">لیست اصناف</a>
                                        <li><a href="{{route('cast.create')}}">اضافه نمودن اصناف</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">محصول »</a>
                                    <ul>
                                        <li><a href="{{route('product.index')}}">لیست محصول</a>
                                        <li><a href="{{route('product.create')}}">اضافه نمودن محصول</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">آرم آگهی »</a>
                                    <ul>
                                        <li><a href="{{route('arm_agahi.index')}}">لیست آرم آگهی</a>
                                        <li><a href="{{route('arm_agahi.create')}}">اضافه نمودن آرم آگهی</a>
                                    </ul>
                                    </li>

                                </ul>
                                </li>

                                <li><a href="#">Admin</a>
                                <ul>
                                    <li><a href="#">Sub Item</a></li>
                                    <li><a href="#">Sub Item</a></li>

                                    <li><a href="#">کاربران »</a>
                                    <ul>
                                        <li><a href="{{route('user.index')}}">لیست کاربران</a>
                                        <li><a href="{{route('user.create')}}">اضافه نمودن کاربران</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">محل پخش »</a>
                                    <ul>
                                        <li><a href="{{route('box_type.index')}}">لیست محل پخش</a>
                                        <li><a href="{{route('box_type.create')}}">اضافه نمودن محل پخش</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">عنوان باکس »</a>
                                    <ul>
                                        <li><a href="{{route('title.index')}}">لیست عنوان باکس</a>
                                        <li><a href="{{route('title.create')}}">اضافه نمودن عنوان باکس</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">نوع کدآگهی »</a>
                                    <ul>
                                        <li><a href="{{route('adver_type.index')}}">لیست نوع کدآگهی</a>
                                        <li><a href="{{route('adver_type.create')}}">اضافه نمودن نوع کدآگهی</a>
                                    </ul>
                                    </li>

                                    <li><a href="#">ضریب نوع کدآگهی »</a>
                                    <ul>
                                        <li><a href="{{route('adver_type_coef.index')}}">لیست ضریب نوع کدآگهی</a>
                                        <li><a href="{{route('adver_type_coef.create')}}">اضافه نمودن ضریب نوع کدآگهی</a>
                                    </ul>
                                    </li>

                                </ul>
                                </li>

                                <li><a href="#">خروج</a></li>
                            </ul> -->
                        <!-- END DOC 1400-06-15 اضافه نمودن منوبار  -->





                            <!--  END DOC 1400-06-14 اضافه نمودن استایل به منوبار یا همان نوبار -- The navigation menu  -->

                            <!-- ST LOCK 1400-06-14  -->
                            <!--      -------------------------------   Adver_Type_Coef   -->
                            <!--
                            <li class="nav-item">
                                <a href="{{route('adver_type_coef.create')}}" class="nav-link">اضافه نمودن ضریب نوع کدآگهی</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('adver_type_coef.index')}}" class="nav-link">لیست ضریب نوع کدآگهی</a>
                            </li>      
                            -->
                            <!--      -------------------------------   Adver_Type   -->
                            <!--
                            <li class="nav-item">
                                <a href="{{route('adver_type.create')}}" class="nav-link">اضافه نمودن نوع کدآگهی</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('adver_type.index')}}" class="nav-link">لیست نوع کدآگهی</a>
                            </li>
                            -->
                            <!--      -------------------------------   Owner   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('owner.create')}}" class="nav-link">اضافه نمودن صاحب اگهی</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('owner.index')}}" class="nav-link">لیست صاحب آگهی</a>
                            </li>
                            -->
                            <!--      -------------------------------   Title   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('title.create')}}" class="nav-link">اضافه نمودن عنوان باکس</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('title.index')}}" class="nav-link">لیست عنوان باکس </a> 
                                -->
                                <!-- برای محاسبه محل پخش آگهی (اولین آگهی و...) اضافه گردید   -->
                                <!--
                            </li>
                            -->

                            <!--      -------------------------------   Product   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('product.create')}}" class="nav-link">اضافه نمودن محصولات</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('product.index')}}" class="nav-link">لیست محصولات</a>
                            </li>
                            -->
                            <!--      -------------------------------   Cast   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('cast.create')}}" class="nav-link">اضافه نمودن اصناف</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('cast.index')}}" class="nav-link">لیست اصناف</a>
                            </li>
                            -->
                            <!--      -------------------------------   Box-Program   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('box_prog_group.create')}}" class="nav-link">اضافه نمودن گروه برنامه</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('box_prog_group.index')}}" class="nav-link">لیست گروه برنامه</a>
                            </li>
                            -->
                            <!--      -------------------------------   Box-Place   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('box_type.create')}}" class="nav-link">اضافه نمودن محل پخش</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('box_type.index')}}" class="nav-link">لیست محل پخش</a>
                            </li>
                            -->
                            <!--      -------------------------------   Arm   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('arm_agahi.create')}}" class="nav-link">اضافه نمودن آرم آگهی</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('arm_agahi.index')}}" class="nav-link">لیست آرم آگهی</a>
                            </li>
                            -->
                            <!--      -------------------------------   Class   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('classes.create')}}" class="nav-link">اضافه نمودن طبقه</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('classes.index')}}" class="nav-link">لیست طبقه</a>
                            </li> 
                            -->
                            <!--      -------------------------------   channel   --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('channel.create')}}" class="nav-link">اضافه نمودن شبکه</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('channel.index')}}" class="nav-link">لیست شبکه</a>
                            </li>
                            -->
                            <!--      -------------------------------    User  --> 
                            <!--
                            <li class="nav-item">
                                <a href="{{route('user.create')}}" class="nav-link">اضافه نمودن کاربر</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.index')}}" class="nav-link">لیست کاربران</a>
                            </li>
                            -->
                            <!-- END LOCK 1400-06-14  -->
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
    // $(document).ready(function()
    // {
    //     $('#products').select2();
    // });

    //  ST DOC 1400-06-21 Add Select 2
        $('#myselect').select2({
        width: '100%',
        placeholder: "Please Select an Option",
        allowClear: true
    });

    $('#myselect-2').select2({
        width: '100%',
        placeholder: "Please Select an Option",
        allowClear: true, 
        tags:true 
    });

    $('#myselect-3').select2({
        width:'100%',
        placeholder:"please Select an Option",
        allowClear:true,
        tags:true
    });

    $('#myselect-4').select2({
        width:'100%',
        placeholder:"please Select an Option",
        allowClear:true,
        tags:true
    });
    //  END DOC 1400-06-21 Add Select 2
    
    //  ST 1400-06-05 For Persian Date   
        jalaliDatepicker.startWatch({
            separatorChar: "/",
            minDate: "attr",
            maxDate: "attr",
            changeMonthRotateYear: true,
            showTodayBtn: true,
            showEmptyBtn: true
        });
        //flatpickr("[data-jdp]");
        document.getElementById("aaa").addEventListener("jdp:change", function (e) { console.log(e) });
    //   END 1400-06-05 For Persian Date  

    </script>

    <style>
        .jdpjdp-container 
        {
            z-index: 999999999999999999999999999999999999999 !important;
        }
    </style>   

</body>
</html>


