@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            
            <div class="col-md-12">
                <a href="{{route('tags.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>
            </div>

            <hr/>

                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card rounded-none">

                                <div class="card-body">
                                    <h6 class="card-title">{{$tag->name}} <span class="text-muted">{{$tag->status['name']}}</span></h6>
                                </div>

                                <ul class="list-group text-center">
                                    <li class="list-group-item">
                                        <img src="{{asset($tag->image)}}" width="200" alt="{{$tag->slug}}">
                                    </li>
                                </ul>

                                <div class="row">
                                    <div class="col-sm-6 text-muted" style="font-size:12px;">
                                        <i class="fas fa-user fa-sm"></i>{{$tag->user['name']}}
                                    </div>
                                    <div class="col-sm-6 text-muted" style="font-size:12px;">
                                        <i class="fas fa-calendar fa-sm"></i>{{date('d M Y h:i:s A',strtotime($tag->created_at))}}
                                        <br>
                                        <i class="fas fa-edit fa-sm"></i>{{date('d M Y h:i:s A',strtotime($tag->updated_at))}}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                
        </div>
        <!-- End Page Content Area  -->

        @endsection 

        @section('css')
        @endsection 

        @section('scripts')
        
        @endsection 



    







