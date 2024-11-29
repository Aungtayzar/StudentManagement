@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('leaves.update',$leave->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="image" class="gallery">

                                        @if($leave->image)
                                            <img src="{{asset($leave->image)}}" alt="{{$leave->slug}}" class="img-thumbnail" width="100" height="100" />
        
                                        @else
                                        <span>Choose Images</span>
                                        @endif
        
        
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" hidden />
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label for="startdate">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="startdate" id="startdate" class="form-control form-control-sm rounded-0" value="{{old('startdate',$leave->startdate)}}" />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="enddate">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="enddate" id="enddate" class="form-control form-control-sm rounded-0" value="{{old('enddate',$leave->enddate)}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Leave title" value="{{old('title',$leave->title)}}" />
                                </div>
    
                                  
                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class <span class="text-danger">*</span></label>
                                    <select name="post_id" id="post_id" class="form-select form-select-sm rounded-0">
                                        @foreach ($posts as $post)

                                            <option value="{{$post['id']}}"
                                                @if($post['id']===$leave['post_id'])
                                                    selected
                                                @endif
                                            >{{$post['title']}}</option>

                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col-md-6 form-group mb-3">
                                    <label for="tag">Tag <span class="text-danger">*</span></label>
                                    <select name="tag" id="tag" class="form-select form-select-sm rounded-0">
                                        @foreach ($tags as $tag)

                                            <option value="{{$tag['id']}}"
                                                @if($tag['id']===$leave['tag_id'])
                                                    selected
                                                @endif
                                            >{{$tag['name']}}</option>

                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something..." >{{old('content',$leave->content)}}</textarea>
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
            <style>
        .gallery{
            width: 100%;
            background-color: #eee;
            color: #000;

            text-align: center;
            padding: 10px;
        }

        .gallery img{
            width: 100%;
            height: 100px;
            border: 2px dashed #aaa;
            border-radius: 10px;
            object-fit: cover;

            padding: 5px;
            margin: 0 5px;
        }

        .gallery.removetxt span{
            display: none;
        }

            </style>
        @endsection 

        @section('scripts')
        <script>
            $(document).ready(function(){

                // Start Single Profile Preview
    
                var previewimages = function(input,output){
                    // console.log(input,output);
    
                    if(input.files){
                        var totalfiles = input.files.length;
                        console.log(totalfiles);
    
                        if(totalfiles > 0){
                            $(".gallery").addClass('removetxt');
                        }else{
                            $('.gallery').removeClass('removetxt');
                        }
    
                        for(var i = 0; i< totalfiles; i++){
    
                            // console.log(i);
    
                            var filereader = new FileReader();
    
                            filereader.onload = function(e){
                                $(output).html("")
                                $($.parseHTML('<img>')).attr('src',e.target.result).appendTo(output);
                            }
    
                            filereader.readAsDataURL(input.files[i]);
                        }
    
                           
                    }   
    
    
                }
    
                
                $('#image').change(function(){
                    previewimages(this,'label.gallery');
                });
    
                 // End Single Profile Preview
                
    
              
            });
    
     
        </script>

        @endsection 



    







