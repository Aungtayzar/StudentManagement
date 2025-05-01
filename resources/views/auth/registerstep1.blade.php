@include('layouts.auth.authheader')


     <form id="stepform" class="mt-3" method="POST" action="{{ route('register.storestep1') }}">
                    @csrf
            
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

                                   
                    <div class="d-grid">
                        <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
                    </div>
        </form>

               



@include('layouts.auth.authfooter')
























