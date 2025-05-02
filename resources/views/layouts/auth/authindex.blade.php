@include('layouts.auth.authheader')
{{-- start reactjs or vuejs  --}}
<div id="app">


    {{-- Page Wrapper  --}}

        <section>


            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-4 p-4">

                        {{-- start inner content area  --}}
                      <div class="row">
                        <h6>@yield('caption')</h6>
                        @yield('content') 

                            {{-- boostrap loader  --}}
                            <div class="d-flex justify-content-center mt-3">
                                <div id="loader" class="spinner-border spinner-border-sm d-none"></div>
                            </div>

                            {{-- social signup  --}}
                            <div class="row">
                                <small class="text-center text-muted mt-3">Sign up with</small>
                                <div class="col-12 text-center mt-2">
                                    <a href="javascript:void(0);" class="btn" title="Login with Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="javascript:void(0);" class="btn" title="Login with Google"><i class="fab fa-google"></i></a>
                                    <a href="javascript:void(0);" class="btn" title="Login with Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="javascript:void(0);" class="btn" title="Login with GitHub"><i class="fab fa-github"></i></a>
                                </div>
                            </div>


                            {{-- login link  --}}
                            <div class="row">
                                <div class="col-12 text-center mt-2">
                                    <small>Already have an account ? <a href="{{route('login')}}" class="text-primary ms-1">Sign In</a></small>
                                </div>
                            </div>

                            {{-- data Policy  --}}
                            <div class="row">
                                <div class="col-12 text-center text-muted mt-2">
                                    <small>By clicking Sign Up, you agree to our <a href="javascript:void(0);" class="fw-bold ms-1">Terms</a>,<a href="javascript:void(0);" class="fw-bold ms-1">Data Policy</a> and <a href="javascript:void(0);" class="fw-bold ms-1">Cookie Policy</a>. You may recive SMS notification from us. </small>
                                </div>
                            </div>

                        {{-- end breadcrumbs --}}

                      </div>

                      {{-- end inner content area  --}}

            

                    </div>
                </div>
            </div>
            
        </section>

    {{-- Page Wrapper  --}}

</div>  
{{-- end reactjs or vuejs  --}}      
@include('layouts.auth.authfooter')