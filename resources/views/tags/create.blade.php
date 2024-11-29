@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('tags.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    <div class="row align-items-end">

                        <div class="col-md-3 form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" placeholder="Enter image Name" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Tag Name" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="status_id">Status</label>
                            <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                @foreach ($statuses as $status)

                                    <option value="{{$status['id']}}">{{$status['name']}}</option>


                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <a href="{{route('tags.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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



    







