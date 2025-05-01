@include('layouts.auth.authheader')
<div id="app">


    {{-- Page Wrapper  --}}

        <section class="vh-100 d-flex justify-content-center align-items-center">


            <div class="col-3 bg-white p-4">
                <h6 class="mb-3">Sign In</h6>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
            
                    <!-- Email Address -->
                    <div class="form-group mb-3">
                        
                        <input id="email" class="form-control form-control-sm rounded-0 @error('email') is-invalide @enderror" type="email" name="email" autofocus value="{{old('email')}}" placeholder="Email"/>
                       {{-- @error('email')
                       <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                       @enderror --}}
                    </div>
            
                    <!-- Password -->
                    <div class="form-group mb-3">
                        
                        <input id="password" class="form-control form-control-sm rounded-0 @error('password') is-invalide @enderror" type="password" name="password" value="{{old('password')}}" placeholder="Password"/>
                       {{-- @error('email')
                       <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                       @enderror --}}
                    </div>
            
                    <!-- Remember Me -->

                    <div class="form-group mb-3">
                        <div class="d-flex">
                            <div class="form-check">
                                <input id="remember_me" class="form-check-input" name="remember" {{old('remember') ? 'checked' : ''}} type="checkbox"/>
                                <label for="remember_me">Remember Me</label>
                            </div>

                            <div class="ms-auto">
                                <a href="{{ route('password.request') }}"><i class="fas fa-lock me-1"></i>Forgot Password ? </a>
                            </div>
                        </div>                   
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-info rounded-0">Log In</button>
                    </div>
                </form>

                {{-- boostrap loader  --}}
                <div></div>

                {{-- social login  --}}
                <div class="row">
                    <small class="text-center text-muted mt-3">Sign in with</small>
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
                        <small>Don't have an account ? <a href="{{route('register')}}" class="text-primary ms-1">Sign Up!</a></small>
                    </div>
                </div>

            </div>
            
        </section>

    {{-- Page Wrapper  --}}

</div>  
@include('layouts.auth.authfooter')

