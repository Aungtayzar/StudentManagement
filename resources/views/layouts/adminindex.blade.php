@include('layouts.adminheader')
{{-- start reactjs or vuejs  --}}
<div id="app">


    {{-- Start Site Setting  --}}
        
    <div id="sitesettings" class="sitesettings">
        <div class="sitesettings-item"><a href="javascript:void(0);" id="sitetoggle" class="sitetoggle"><i class="fas fa-cog ani-rotates"></i></a></div>
    </div>
        

    {{-- End Site Setting  --}}

    {{-- Start Leftsidebar  --}}
        @include('layouts.adminleftsidebar')
    {{-- End Leftsidebar  --}}

    {{-- Page Wrapper  --}}

        <section>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-9 pt-md-5 mt-md-3 ms-auto">

                        {{-- start inner content area  --}}
                      <div class="row">

                        {{-- @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        
                        @endif

                        @if(session('info'))
                            <div class="alert alert-info">
                                {{session('info')}}
                            </div>
                        
                        @endif

                        @if($errors)
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                        @endforeach
                            
                        
                        @endif --}}


                        {{-- start breadcrumbs  --}}

                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Previous</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0);">Current</a></li>
                            </ol>
                        </nav>

                        {{-- end breadcrumbs --}}

                        @yield('content') 
                      </div>

                      {{-- end inner content area  --}}

            

                    </div>
                </div>
            </div>
            
        </section>

    {{-- Page Wrapper  --}}

</div>  
{{-- end reactjs or vuejs  --}}      



@include('layouts.adminfooter')