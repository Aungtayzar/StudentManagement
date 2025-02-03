@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('contacts.update',$contact->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    @method('PUT')
                    <div class="row align-items-end">


                        <div class="col-md-3 form-group">
                            <label for="firstname">Firstname <span class="text-danger">*</span></label>
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm rounded-0" placeholder="Enter Firstname Name" value="{{old('firstname',$contact->name)}}" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="lastname">lastname <span class="text-danger">*</span></label>
                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm rounded-0" placeholder="Enter Lastname Name" value="{{old('lastname',$contact->name)}}" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="birthday">Birthday <span class="text-danger">*</span></label>
                            <input type="text" name="birthday" id="birthday" class="form-control form-control-sm rounded-0" placeholder="Enter Birthday Date" value="{{old('birthday',$contact->name)}}" />
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="relative_id">Status</label>
                            <select name="relative_id" id="relative_id" class="form-control form-control-sm rounded-0">
                                @foreach ($relatives as $relative)

                                    <option value="{{$contact['id']}}"
                                        @if($relative['id']===$contact['relative_id'])
                                            selected
                                        @endif
                                    >{{$relative['name']}}</option>


                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-3">
                            <a href="{{route('contacts.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
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



    







