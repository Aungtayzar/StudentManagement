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
                            <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
                        </div>

                        @if(session('status') == 'verification-link-sent')
                            <small class="text-primary text-sm mb-4">
                                A new verification link has been sent to the email address you provided during registration.
                            </small>
                        @endif                          
                        
                        <form class="mt-3" method="POST" action="{{ route('verification.send') }}">
                            @csrf                                           
                            <div class="d-grid">
                                <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Resend Verification Email</button>
                            </div>                            
                        </form>

                        <div class="text-center mt-2">
                            <small>Don't have an action ? </small>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="small" onclick="event.preventDefault(); this.closest('form').submit();" >Sign Out</a>
                            </form>
                        </div>
                      </div>

                      {{-- end inner content area  --}}

            

                    </div>
            </div>
            
    {{-- Page Wrapper  --}}

</div>  
{{-- end reactjs or vuejs  --}}    

@extends('layouts.auth.authfooter')
