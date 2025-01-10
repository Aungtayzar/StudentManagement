
<!-- bootstrap css1 js1  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- jquery  -->
<script src="{{asset('assets/libs/jquery-3.7.1.min.js')}}" type="text/javascript"></script>
<!-- custom js js1 -->
<script src="{{asset('assets/dist/js/app.js')}}" type="text/javascript"></script>
<!-- toastr notification css1 js1 -->
<script src="{{asset('assets/libs/toastr-master/build/toastr.min.js')}}"></script>


                        @if(Session::has('success'))
                            <script>toastr.success("{{session()->get('success')}}", 'Successfull')</script>
                        
                        @endif

                        @if(session('info'))
                        <script>toastr.info("{{session()->get('info')}}", 'Information')</script>
                        
                        @endif

                        @if(session('error'))
                        <script>toastr.error("{{session()->get('error')}}", 'inconceivable')</script>
                        
                        @endif

                        

                        @if($errors)
                        @foreach($errors->all() as $error)
                        <script>toastr.error("{{$error}}", 'Warning',{timeOut:3000})</script>
                        @endforeach
                            
                        
                        @endif

{{-- extra js --}}
@yield('scripts')
</body>
</html>
