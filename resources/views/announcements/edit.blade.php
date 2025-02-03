@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('announcements.update',$announcement->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="image" class="gallery">

                                        @if(!empty($announcement->image))
                                           
                                            <img src="{{asset($announcement->image)}}" alt="{{$announcement->id}}" class="img-thumbnail" width="100" height="100" />
                                            
        
                                        @else
                                        <span>Choose Images</span>
                                        @endif

        
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm rounded-0" hidden multiple />
                                </div>

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control form-control-sm rounded-0" placeholder="Enter Announcement title" value="{{old('title',$announcement->title)}}" />
                                </div>
    
                                  
                                <div class="col-md-6 form-group mb-3">
                                    <label for="post_id">Class <span class="text-danger">*</span></label>
                                    <select name="post_id[]" id="post_id" class="form-select form-select-sm rounded-0" multiple>
                                        {{-- Coalescing Operator  --}}
                                        @foreach ($posts as $id=>$title)

                                            <option value="{{$id}}"  {{in_array($id,json_decode($announcement->post_id,true) ?? []) ? 'selected' : ''}}>{{$title}}</option>

                                        @endforeach
                                    </select>
                                </div>
        
    
                                <div class="col-md-12 form-group mb-3">
                                    <label for="content">Content <span class="text-danger">*</span></label>
                                    <textarea name="content" id="content" class="form-control form-control-sm rounded-0" rows="5" placeholder="Say Something..." >{{old('content',$announcement->content)}}</textarea>
                                </div>
        
        
                                <div class="col-md-12 d-flex justify-content-end">
                                    <a href="{{route('announcements.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
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
        <link href="{{asset('assets/libs/select2-develop/dist/css/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet">
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
        <script src="{{asset('assets/libs/select2-develop/dist/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/libs/summernote-0.8.18-dist/summernote-lite.min.js')}}"></script>
        <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
        <script>
            $(document).ready(function(){

                $('#tag').select2({
                    placeholder:"Choose Authorize person"
                });

                $('#post_id').select2({
                    placeholder:"Choose Class"
                });

                $('#content').summernote({
                    placeholder: 'Say Something...',
                    height: 120,
                    toolbar: [
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link']],
                    ],
                });

                console.log("Summernote initialized.");

                $('#startdate,#enddate').flatpickr({
                    dateFormat:"Y-m-d",
                    minDate:"today",
                    maxDate:new Date().fp_incr(30)
                });

                console.log("Flatpickr initialized.");

                // Start Multi Profile Preview
    
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
                                $($.parseHTML('<img>')).attr('src',e.target.result).appendTo(output);
                            }
    
                            filereader.readAsDataURL(input.files[i]);
                        }
    
                           
                    }   
    
    
                }
    
                
                $('#image').change(function(){
                    previewimage(this,'label.gallery');
                });
    
                 // End Multi Profile Preview
                
    
              
            });
    
     
        </script>

        @endsection 



    







