<!DOCTYPE html>
<html>
    <head>
        <title>{{config('app.name')}}</title>

         {{--link fav icon--}}
         <link href="{{asset('assets/img/fav/favicon.png')}}" type="image/png" size="16x16" />

        <!--fontawesome cdn version 5.15.4-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!--bootstrap css 1 version 5.3.0-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!-- toastr notification css1 js1 -->
        <link href="{{asset('assets/libs/toastr-master/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />

        <!--Custom Css-->
        <link href="{{asset('assets/dist/css/style.css')}}" rel="stylesheet" type="text/css" />

        {{-- extra Css  --}}
        @yield('css')

    </head>
    <body>