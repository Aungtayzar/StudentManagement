@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            
            <div class="col-md-12">
                <a href="{{route('announcements.create')}}" class="btn btn-primary btn-sm rounded-0">Create</a>
            </div>

            <hr/>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-2"><a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a></div>

                        <div class="col-md-6">
                            <form action="{{route('announcements.index')}}" method="GET">
                            {{csrf_field()}}
                            {{-- @csrf  --}}
                                <div class="row justify-content-end">
                                    <div class="col-md-4 col-sm-4 mb-2">
                                        <div class="form-group">
                                            <select name="statusfilter" id="statusfilter" class="form-select form-select-sm rounded-0">
                                                <option selected disabled>Choose Status</option>
                                                @foreach($statuses as $status)
                                                <option value="{{$status->id}}" {{request('statusfilter') == $status->id ? 'selected': ''}}>{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-8 mb-2">
                                        <div class="input-group">
                                            <input type="text" name="namefilter" id="namefilter" class="form-control form-control-sm rounded-0" placeholder="Search...." />
                                            <a href="{{route('announcements.index')}}" id="btn-clear" class="btn btn-secondary btn-sm"><i class="fas fa-sync"></i></a>
                                            <button type="submit" id="search-btn" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <table id="mytable" class="table table-sm table-hover border">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="selectalls" id="selectalls" class="form-check-input selectalls" />
                                </th>
                                <th>No</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($announcements as $idx=>$announcement)
                                <tr id="delete_{{$announcement->id}}">
                                    <td>
                                        <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$announcement->id}}">
                                    </td>
                                    <td>{{$idx+ $announcements->firstItem()}}</td>

                                    {{-- (1-1) x 5 + 0 + 1 --}}
                                        {{-- 0 + 0 + 1 --}}
                                        {{-- 1 --}}

                                    {{-- <td>{{($announcements->currentPage() - 1) * $announcements->perPage() + $idx + 1}}</td> --}}
                                    <td><a href="{{route('announcements.show',$announcement->id)}}">{{Str::limit($announcement->title,20)}}</a></td>                           
                                    <td>{{$announcement['status']['name']}}</td>
                                    <td>{{$announcement['user']['name']}}</td>
                                    <td>{{$announcement->created_at->format('d M Y')}}</td>
                                    <td>{{$announcement->updated_at->format('d M Y')}}</td>
                                    <td>
                                        <a href="{{route('announcements.edit',$announcement->id)}}" class="text-info "><i class="fas fa-pen"></i></a>
                                        <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx={{$idx}}><i class="fas fa-trash-alt"></i></a>
                                        <form id="formdelete-{{$idx}}" action="{{route('announcements.destroy',$announcement->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$announcements->links('pagination::bootstrap-5')}}
                </div>
        </div>
        <!-- End Page Content Area  -->

        @endsection 

        @section('css')
        @endsection 

        @section('scripts')
        <script type="text/javascript">
            
            $(document).ready(function(){

                //Single Delete

                $('.delete-btn').click(function(){
                    const getidx = $(this).data('idx');
                    // console.log(getidx);

                    if(confirm(`Are you sure you want to delete ${getidx}`)){
                        $('#formdelete-'+getidx).submit();
                        return true;
                        
                    }else{
                        return false;
                    }

                });

                 //Single Delete

                //  Bulk Delete 
                $('#bulkdelete-btn').hide();
                $('#selectalls').click(function(){
                    $('.singlechecks').prop('checked',$(this).prop('checked'));
                    togglebulkdeletebtn();
                });

                $(document).on('change','.singlechecks',function(){
                    togglebulkdeletebtn();
                });

                function togglebulkdeletebtn(){
                    let selectedcount = $('.singlechecks:checked').length;
                    if(selectedcount > 0){
                        $('#bulkdelete-btn').show();
                    }else{
                        $('#bulkdelete-btn').hide();
                    }
                }

                $('#bulkdelete-btn').click(function(){
                    let getselectedids = [];

                    $("input:checkbox[name='singlechecks']:checked").each(function(){
                        getselectedids.push($(this).val());
                    });

                    // console.log(getselectedids);

                    $.ajax({
                        url:'{{route("announcements.bulkdeletes")}}',
                        type:"DELETE",
                        dataType:"json",
                        data:{
                            selectedids:getselectedids,
                            _token:'{{csrf_token()}}'
                        },
                        success:function(response){
                            // console.log(response);

                            if(response){
                                // ui remove 
                                $.each(getselectedids,function(key,value){
                                    $(`#delete_${value}`).remove();
                                })
                            }
                        },
                        error:function(response){
                            console.log("Error : ",response);
                        }
                    });

                    
                });

                // Bulk Delete
            })
        </script>
        @endsection 



    







