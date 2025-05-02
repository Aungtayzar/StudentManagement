@include('layouts.auth.authheader')

@section('caption','Contact Information')
@section('content')
     <form id="stepform" class="mt-3" method="POST" action="{{ route('register.storestep3') }}">
                    @csrf
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
                        <button type="submit" id="submitbtn" class="btn btn-info rounded-0">Next</button>
                    </div>
        </form>

               
@endsection
























