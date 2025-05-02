@extends('layouts.auth.authheader')

{{-- start reactjs or vuejs  --}}
<div id="app">


    {{-- Page Wrapper  --}}

            <div class="vh-100 d-flex justify-content-center align-items-center">
                    <div class="col-3 bg-white p-4">

                        {{-- start inner content area  --}}
                      <h6>New Password!</h6>
                      <div class="row">                      
                        
                        <form class="mt-3" method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group mb-3">
                                <input type="email" id="email" name="email" class="form-control form-control-sm rounded-0" :value="old('email', $request->email)" placeholder="Enter your eamil"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" id="password" name="password" class="form-control form-control-sm rounded-0" :value="old('password')" autofocus placeholder="Enter your Password"/>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-sm rounded-0" :value="old('password_confirmation')" autofocus placeholder="Enter your Password"/>
                            </div>
                                           
                            <div class="d-grid">
                                <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Reset Password</button>
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
