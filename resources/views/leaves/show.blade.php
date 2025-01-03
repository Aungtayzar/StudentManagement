@extends('layouts.adminindex')
@section('content')
<!-- Start Page Content Area  -->
<div class="container-fluid">
    
    <div class="col-md-12">
        <a href="{{route('leaves.index')}}" id="btn-back" class="btn btn-secondary btn-sm rounded-0">Close</a>
        <a href="javascript:void(0);" id="btn-back" class="btn btn-secondary btn-sm rounded-0">Back</a>
    </div>

    <hr/>

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-4 col-lg-3 mb-2">
                <h6>Info</h6>
                <div class="card border-0 shadow rounded-none">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center mb-3">
                            <div class="h5 mb-1">{{$leave->title}}</div>
                            <div class="text-muted">
                                <span>{{$leave["stage"]["name"]}}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row g-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col ps-3">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Tag</h6>
                                        </div>
                                        <div class="col-auto">
                                            {{-- <a href="javascript:void(0);">{{$leave->maptagtonames($users)}}</a> --}}
                                            @foreach($leave->tagpersons($leave->tag) as $id => $name)
                                                <a href="javascript:void(0);">{{$name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-9">
                <h6>Compose</h6>
                <div class="card border-0 rounded-0 shadow mb-4">
                    <div class="card-body">
                        <div class="accordion">
                            <h1 class="acctitle">Email</h1>
                            <div class="accontent">
                                <div class="col-md-12 py-3">
                                    <form action="" method="">
                                        @csrf 
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 rounded-0" placeholder="To:" value="" readonly />
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <input type="text" name="cmpsubject" id="cmpsubject" class="form-control form-control-sm border-0 rounded-0" placeholder="Subject" value="" />
                                            </div>

                                            <div class="col-md-12 form-group mb-3">
                                                <textarea name="cmpcontent" id="cmpcontent" class="form-control form-control-sm border-0 rounded-0" rows="3" placeholder="Your message here..." style="resize: none"></textarea>
                                            </div>

                                            <div class="col d-flex justify-content-end align-items-end">
                                                <button type="submit" class="btn btn-secondary btn-sm rounded-0">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                             </div>
                       </div>
                    </div>
                </div>

                <h6>Class</h6>
                <div class="card border-0 rounded-0 shadow mb-4">
                    <div class="card-body d-flex flex-wrap gap-3">
                        @foreach($leave->tagposts($leave->post_id) as $id=>$title)
                        <div class="border shadow p-3 enrollboxes">
                            <a href="{{route('posts.show', $id)}}">{{$title}}</a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <h6>Additional Info</h6>
                <div class="card border-0 rounded-0 shadow mb-4">
                    <ul class="nav"> 
                        <li class="nav-item">
                            <button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'contenttab')">Content</button>
                            <button type="button" class="tablinks" onclick="gettab(event,'leavetab')">Leaves</button>
                        </li>
                        
                    </ul>


                    <div class="tab-content">

                        <div id="contenttab" class="tab-pane">
                            <p>{!! $leave->content !!}</p>
                            @if(!empty($leavefiles) && $leavefiles->count() > 0)
                                    @foreach ($leavefiles as $leavefile)
                                    <a href="{{asset($leavefile->image)}}" data-lightbox="image" data-title="{{$leave->title}}">
                                        <img src="{{asset($leavefile->image)}}" alt="{{$leavefile->id}}" class="img-thumbnail" width="100" height="100" /> 
                                    </a>
                                    
                                    @endforeach
                                            
        
                                 @else
                                    <span>No Files</span>
                             @endif
                
                        </div>

                        <div id="leavetab" class="tab-pane">
                            <table id="mytable" class="table table-sm table-hover border">
                                <thead>
                                    <tr>
                            
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Tag</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @foreach ($allleaves as $idx=>$allleave)
                                        <tr>
                                            <td>{{++$idx}}</td>
                                            <td><a href="{{route('leaves.show',$allleave->id)}}">{{Str::limit($allleave->title,20)}}</a></td>   
                                            <td>
                                                {{$allleave->maptagtonames($users)}}
                                            </td>                         
                                            <td>{{$allleave->startdate}}</td>
                                            <td>{{$allleave->enddate}}</td>
                                            <td>{{$allleave['stage']['name']}}</td>
                                            <td>{{$allleave['user']['name']}}</td>
                                            <td>{{$allleave->created_at->format('d M Y')}}</td>
                                            <td>{{$allleave->updated_at->format('d M Y')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                
                        </div>
                               
                        
                    </div>
                        
                    
                </div>

                <h6>Control Section</h6>
                <div class="card border-0 rounded-0 shadow mb-4">
                    <ul class="nav"> 
                        <li class="nav-item">
                            <button type="button" class="tablinks active" onclick="gettab(event,'authorizationtag')">Authorization</button>
                        </li>
                        
                    </ul>


                    <div class="tab-content">

                        <div id="authorizationtag" class="tab-pane">
                            <form action="{{route('leaves.updatestage',$leave->id)}}" method="POST">
                                {{-- {{csrf_field()}} --}}
                                @csrf 
                                @method('PUT')           
                                    
                                        
                                                                                                   
                                            <div class="col-md-3 form-group mb-3">
                                                <select name="stage_id" id="stage_id" class="form-select form-select-sm rounded-0">
                                                    @foreach ($stages as $stage)   
                                                        <option value="{{$stage->id}}" {{$leave->stage_id == $stage->id ? 'selected':''}}>{{$stage->name}}</option>   
                                                    @endforeach
                                                </select>
                                            </div>
                    
                                            
                    
                                            <div class="col-md-3 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                            </div>
                                        
                                    
            
                                
                                
                            </form>
            
                
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
<link rel="stylesheet" href={{asset("assets/libs/lightbox2-dev/dist/css/lightbox.min.css")}}>
<style>

    /* Start Accordion  */
.accordion{
    	width: 100%;
}

.acctitle{
	background: #777;
	color: #fff;
	font-size: 14px;
	padding: 15px;
	cursor: pointer;
	user-select: none;
	position: relative;
}

.acctitle:hover,.active{
	background-color: steelblue;
}

.acctitle::after{
	content: '\f067';
	font-family: 'Font Awesome 5 Free';

	position: absolute;
	right: 15px;
	top: 50%;

	transform: translateY(-50%);
}

.active::after{
	content: '\f068';
}

.accontent{
	height: 0;
	background-color: #f4f4f4;

	text-indent: 50px;
	text-align: justify;
	font-size: 14px;

	padding: 0 20px;

	overflow: hidden;

	transition: height .5s ease-in-out;
}

/* End Accordion  */

/* Start Tab  */
.nav{
	background-color: #f1f1f1;
	display: flex;

	padding: 0;
	margin: 0;

	
}

.nav .nav-item{
	list-style-type: none;
}

.nav .tablinks{

	font-size: 17px;
	border: none;
	outline: none;
	cursor: pointer;
	padding: 14px 16px;

	transition: background-color 0.3s;

}

.nav .tablinks:hover{
	background-color: #f3f3f3;

}

.nav .tablinks.active{
	color: blue;
}


.tab-pane{
	border: 1px solid #ccc;
	border-top: none;

	padding: 6px 12px;

	display: none;
}



/* End Tab  */


</style>
@endsection 

@section('scripts')
<script src={{asset("assets/libs/lightbox2-dev/dist/js/lightbox.min.js")}}></script>
<script>
var getacctitles = document.getElementsByClassName("acctitle");
console.log(getacctitles);//HTMLCollection
var getactiveacctitles = document.querySelectorAll(".accontent");

for(var x = 0;x<getacctitles.length;x++){
	

	getacctitles[x].addEventListener('click',function(e){
		

		this.classList.toggle('active');

		var getcontent = this.nextElementSibling;
		
		console.log(getcontent.scrollHeight+"px");

		

		if(getcontent.style.height){
			getcontent.style.height = null;//beware can't set 0
		}else{
			getcontent.style.height = getcontent.scrollHeight + "px";
		}
	});

	if(getacctitles[x].classList.contains('active')){
		getactiveacctitles[x].style.height = getactiveacctitles[x].scrollHeight+"px"
	}
}


// Start Tab 
var gettabpanes  = document.getElementsByClassName('tab-pane'),
    gettablinks = document.getElementsByClassName('tablinks');


    var tabpanes = Array.from(gettabpanes);


    function gettab(evn,link){
    	// console.log(env.target);
    	// console.log(link);


    	tabpanes.forEach(function(tabpane){
    		tabpane.style.display = 'none';
    	});

        for(var x=0;x<gettablinks.length;x++){
         gettablinks[x].className = gettablinks[x].className.replace(' active','');

         
        }



        document.getElementById(link).style.display="block";



        evn.currentTarget.className += ' active';


    	
    }

document.getElementById('autoclick').click();

lightbox.option({
    'resizeDuration':100
})

// End Tab 
</script>
@endsection 




    







