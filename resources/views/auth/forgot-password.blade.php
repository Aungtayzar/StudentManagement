@extends('layouts.auth.authheader')

{{-- start reactjs or vuejs  --}}
<div id="app">


    {{-- Page Wrapper  --}}

            <div class="vh-100 d-flex justify-content-center align-items-center">
                    <div class="col-3 bg-white p-4">

                        {{-- start inner content area  --}}
                      <h6>Forgot Password!</h6>
                      <div class="row">
                        <div>
                            <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                        </div>

                        @if(session('status'))
                            <small class="text-primary text-sm mb-4">
                                A new link has been sent to the email address you provided during registration. 
                            </small>
                        @endif
                            
                        

                        <form class="mt-3" method="POST" action="{{ route('password.email') }}">
                            @csrf
                    
                            <div class="form-group mb-3">
                                <input type="email" id="email" name="email" class="form-control form-control-sm rounded-0" value="{{old('email')}}" autofocus placeholder="Enter your eamil"/>
                            </div>
                                           
                            <div class="d-grid">
                                <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Email Password Reset Link</button>
                            </div>
                        </form>
                      </div>

                      {{-- end inner content area  --}}

            

                    </div>
            </div>
            
    {{-- Page Wrapper  --}}

</div>  
{{-- end reactjs or vuejs  --}}    

@extends('layouts.auth.authfooter')

     





