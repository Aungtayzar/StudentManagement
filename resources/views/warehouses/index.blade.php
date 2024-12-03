@extends('layouts.adminindex')
        @section('content')
        <!-- Start Page Content Area  -->
        <div class="container-fluid">
            <div class="col-md-12">
                <form action="{{route('warehouses.store')}}" method="POST">
                    {{csrf_field()}}
                    {{-- @csrf  --}}
                    <div class="row align-items-end">

                        <div class="col-md-4 form-group mb-3">
                            <label for="name">Name <span class="text-danger">*</span></label> 
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror                              
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder="Enter Warehouse Name" />
                        </div>

                        <div class="col-md-4 form-group mb-3">
                            <label for="status_id">Status</label>
                            @error('status_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <select name="status_id" id="status_id" class="form-control form-control-sm rounded-0">
                                @foreach ($statuses as $status)

                                    <option value="{{$status['id']}}">{{$status['name']}}</option>


                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-4 mb-3">
                            <button type="reset" class="btn btn-secondary btn-sm rounded-0">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

                <hr>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2 mb-2"><a href="javascript:void(0);" id="bulkdelete-btn" class="btn btn-danger btn-sm rounded-0">Bulk Delete</a></div>

                        <div class="col-md-10 mb-2">
                            <form action="" method="">
                            {{csrf_field()}}
                            {{-- @csrf  --}}
                                <div class="row justify-content-end">
                                    <div class="col-md-2 col-sm-6 mb-2">
                                        <div class="input-group">
                                            <input type="text" name="filtername" id="filtername" class="form-control form-control-sm rounded-0" placeholder="Search...." />
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
                                <th>Name</th>
                                <th>Status</th>
                                <th>By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($warehouses as $idx=>$warehouse)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="singlechecks" class="form-check-input singlechecks" value="{{$warehouse->id}}">
                                    </td>
                                    <td>{{++$idx}}</td>
                                    <td>{{$warehouse->name}}</td>
                                    <td>{{$warehouse->status->name}}</td>
                                    <td>{{$warehouse['user']['name']}}</td>
                                    <td>{{$warehouse->created_at->format('d M Y')}}</td>
                                    <td>{{$warehouse->updated_at->format('d M Y')}}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="text-info "><i class="fas fa-pen"></i></a>
                                        <a href="javascript:void(0);" class="text-danger ms-2 delete-btn" data-idx={{$idx}}><i class="fas fa-trash-alt"></i></a>
                                        <form id="formdelete-{{$idx}}" action="{{route('warehouses.destroy',$warehouse->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                $('#selectalls').click(function(){
                    $('.singlechecks').prop('checked',$(this).prop('checked'));
                })

                // Bulk Delete
            })
        </script>
        @endsection 



    







