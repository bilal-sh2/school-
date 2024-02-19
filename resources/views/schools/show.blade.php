@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Al-Amir</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
      body::before {
    content: "";
    background-image: url('لوغو دار حفص القراءة والتجويد نهااائي.png');
    background-attachment: fixed;
    background-position: center bottom; /* توضيح موقع الصورة في الوسط الأفقي وأسفل العمودي */
    background-size: cover;
    opacity: 0.1; /* تعديل شفافية الصورة */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* تأكد من أن الصورة خلفية */
}.logo-container {
    float: left;
}
    body {
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        direction: rtl;
        text-align: right;
        margin: 20px;
    }

    h3 {
        text-align: center; /* توسيط العنوان */
        margin-top: 50px; /* تعديل التباعد العلوي */
        color: #333; /* لون النص */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* ظل النص */
    }
    .a1{
        text-decoration: none; /* إزالة التزيين الافتراضي للروابط */

-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border: 0;
font-size: 18px;
padding: 10px 20px;
display: inline-block;
color: #fff;
text-transform: uppercase;
border-radius: 500px;
font-weight: bold;
font-family: Arial;
background: linear-gradient(90deg, #0074cc, #0064b7, #0055a2, #00448d, #003379, #002364, #00124f, #00013a);
background-size: 1800% 100%;
-webkit-animation: rainbow 6s linear infinite;
animation: rainbow 6s linear infinite;
}

@-webkit-keyframes rainbow {
0% {
    background-position: 200% 0;
}
100% {
    background-position: -200% 0;
}
}

@keyframes rainbow {
0% {
    background-position: 200% 0;
}
100% {
    background-position: -200% 0;
}
}



.a2{
    text-decoration: none; /* إزالة التزيين الافتراضي للروابط */

         -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      border: 0;
      font-size: 18px;
      padding: 10px 20px;
      display: inline-block;
      color: #fff;
      text-transform: uppercase;
      border-radius: 500px;
      font-weight: bold;
      font-family: Arial;
      background: linear-gradient(90deg, #32CD32, #006400, #FFDEAD, #DAA520, #20AAB2	, #ADFF2F	, #7ca5de, #3e73bd);
      background-size: 1800% 100%;
      -webkit-animation: rainbow 10s linear infinite;
      animation: rainbow 10s linear infinite;
    }

    @-webkit-keyframes rainbow {
      0% {
        background-position: 200% 0;
      }
      100% {
        background-position: -200% 0;
      }
    }

    @keyframes rainbow {
      0% {
        background-position: 200% 0;
      }
      100% {
        background-position: -200% 0;
      }
    }

  
</style>

<body>
    <!-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('school.index') }}">الرجوع</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{'الصفحة الرئيسية' }}</a>
                        </li>
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <h3>صفحة التحكم لمدرسة: {{$school->name}}</h3>
<br>
    <div class="container">
        <table border="0" id="classTable" class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <p>إجرائيات الصف</p>
                    </td>
                    <td>
                    <div class="col-sm">
                        <a  class="a1" href="{{ route('school_class2.create', ['id' => $id]) }}">إنشاء صف جديد</a>
                        </div>
                    </td>
                    <td>
                        <a class="a2" href="{{ route('school_class22.index2', ['id' => $id]) }}">عرض الصفوف</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>إجرائيات المعلم</p>
                    </td>
                    <td>
                        <a class="a1" href="{{ route('teacher22.create', ['id' => $id]) }}">إضافة معلم جديد</a>
                    </td>
                    <td>
                        <a class="a2" href="{{ route('teacher2.index2', ['id' => $id]) }}">عرض المعلمين</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
@endsection
