@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('relatives.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    <div class="row align-items-end">


                        <div class="col-md-3 form-group mb-3">
                            <label for="name">Firstname <span class="text-danger">*</span></label>
                            @error('firstname')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="text" name="firstname" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Role Name" />
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="name">Lastname <span class="text-danger">*</span></label>
                            @error('lastname')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="text" name="lastname" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Role Name" />
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="name">Birthday <span class="text-danger">*</span></label>
                            @error('birthday')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input type="text" name="birthday" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Role Name" />
                        </div>

                        <div class="col-md-3 form-group mb-3">
                            <label for="status_id">Relative</label>
                            @error('relative_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <select name="relative_id" id="relative_id" class="form-control form-control-sm rounded-0">
                                @foreach ($relatives as $relative)

                                    <option value="{{$relative['id']}}">{{$relative['name']}}</option>


                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <a href="{{route('relatives.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

               
        </div>
        <!-- End Page Content Area  -->

        @endsection 

        @section('css')
        @endsection 

        @section('scripts')
        @endsection 



    







