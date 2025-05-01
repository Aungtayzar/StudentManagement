@include('layouts.auth.authheader')
<div id="app">


    {{-- Page Wrapper  --}}

        <section class="vh-100 d-flex justify-content-center align-items-center">


            <div class="col-3 bg-white p-4">
                <h6 class="mb-3">Register</h6>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
            
                    <!-- First Name-->
                    <div class="form-group mb-3">
                        <input type="text" id="firstname" name="firstname" class="form-control form-control-sm rounded-0" autofocus value="{{old('firstname')}}" placeholder="First Name"/>
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" id="lastname" name="lastname" class="form-control form-control-sm rounded-0" value="{{old('lastname')}}" placeholder="Last Name"/>
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" id="email" name="email" class="form-control form-control-sm rounded-0" value="{{old('email')}}" placeholder="Email"/>
                    </div>
            
                    <!-- Password -->
                    <div class="form-group mb-3">
                        
                        <input id="password" class="form-control form-control-sm rounded-0" type="password" name="password" value="{{old('password')}}" placeholder="Password"/>
                    </div>

                    <div class="form-group mb-3">
                        
                        <input id="password_confirmation" class="form-control form-control-sm rounded-0" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Confirm Password"/>
                    </div>

                    <div class="form-group mb-3">
                        <label for="gender_id">Gender <span class="text-danger">*</span></label>
                        <select id="gender_id" class="form-select form-select-sm rounded-0" name="gender_id">
                            <option selected disabled>Choose a gender</option>
                            {{-- @foreach ($gneders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="age">Age <span class="text-danger">*</span></label>
                        <input type="number" name="age" id="age" class="form-control form-control-sm rounded-0" value="{{old('age')}}" placeholder="Enter your Age" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="country_id">Gender <span class="text-danger">*</span></label>
                        <select id="country_id" class="form-select form-select-sm rounded-0" name="country_id">
                            <option selected disabled>Choose a country</option>
                            {{-- @foreach ($countries as $country)
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="city_id">City <span class="text-danger">*</span></label>
                        <select id="city_id" class="form-select form-select-sm rounded-0" name="city_id">
                            <option selected disabled>Choose a city</option>

                        </select>
                    </div>

                
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info rounded-0">Sign Up</button>
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
                        <small>Already have an account ? <a href="{{route('login')}}" class="text-primary ms-1">Sign In</a></small>
                    </div>
                </div>

                {{-- data Policy  --}}
                <div class="row">
                    <div class="col-12 text-center text-muted mt-2">
                        <small>By clicking Sign Up, you agree to our <a href="javascript:void(0);" class="fw-bold ms-1">Terms</a>,<a href="javascript:void(0);" class="fw-bold ms-1">Data Policy</a> and <a href="javascript:void(0);" class="fw-bold ms-1">Cookie Policy</a>. You may recive SMS notification from us. </small>
                    </div>
                </div>

            </div>
            
        </section>

    {{-- Page Wrapper  --}}

</div>  
@include('layouts.auth.authfooter')
























