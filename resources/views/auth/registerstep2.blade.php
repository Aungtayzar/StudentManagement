@include('layouts.auth.authheader')


     <form id="stepform" class="mt-3" method="POST" action="{{ route('register.storestep2') }}">
                    @csrf
                    <!-- First Name-->
                    <div class="form-group mb-3">
                        <input type="text" id="firstname" name="firstname" class="form-control form-control-sm rounded-0" autofocus value="{{old('firstname')}}" placeholder="First Name"/>
                    </div>

                    <div class="form-group mb-3">
                        <input type="text" id="lastname" name="lastname" class="form-control form-control-sm rounded-0" value="{{old('lastname')}}" placeholder="Last Name"/>
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
                    

                                   
                    <div class="d-grid">
                        <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
                    </div>
        </form>

               



@include('layouts.auth.authfooter')
























