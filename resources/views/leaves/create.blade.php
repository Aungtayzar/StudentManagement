@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('leaves.store')}}" method="POST" enctype="multipart/form-data">
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
                                        @error('startdate')
                                         <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date <span class="text-danger">*</span></label>
                                        @error('enddate')
                                         <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$gettoday)}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title</label>
                                    @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Leave title" value="{{old('title')}}" />
                                </div>
    
                                  
                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class <span class="text-danger">*</span></label>
                                    @error('post_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <select name="post_id" id="post_id" class="form-select form-select-sm rounded-0">
                                        <option selected disabled>Choose Class</option>
                                        @foreach ($posts as $post)   
                                            <option value="{{$post['id']}}" {{old('post_id') == $post->id ? 'selected':''}}>{{$post['title']}}</option>   
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag <span class="text-danger">*</span></label>
                                    @error('tag')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <select name="tag" id="tag" class="form-select form-select-sm rounded-0">
                                        <option selected disabled>Choose authorize person</option>
                                        @foreach ($tags as $tag)
        
                                            <option value="{{$tag['id']}}" {{old('tag') == $tag->id ? 'selected':''}}>{{$tag['name']}}</option>
        
        
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    @error('content')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something..." >{{old('content')}}</textarea>
                                </div>
        
        
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{route('leaves.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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



    







