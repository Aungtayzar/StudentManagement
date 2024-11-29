@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}

                    <div class="row">

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" placeholder="Enter image Name" />
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Post title" />
                                </div>
    
                                  
                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class <span class="text-danger">*</span></label>
                                    <select name="post_id" id="post_id" class="form-select form-select-sm rounded-0">
                                        <option value="selected disabled">Choose Class</option>
                                        @foreach ($posts as $post)   
                                            <option value="{{$post['id']}}">{{$post['title']}}</option>   
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag <span class="text-danger">*</span></label>
                                    <select name="tag" id="tag" class="form-select form-select-sm rounded-0">
                                        <option value="selected disabled">Choose authorize person</option>
                                        @foreach ($tags as $tag)
        
                                            <option value="{{$tag['id']}}">{{$tag['name']}}</option>
        
        
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something..." ></textarea>
                                </div>
        
        
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{route('posts.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                </div>
                            </div>
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



    







