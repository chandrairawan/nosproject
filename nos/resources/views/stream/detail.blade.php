@extends('app')

@section('content')
<title>System Notification</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <a href="{{ URL::previous() }}"><button style="width: 100%;" type="submit" class="btn btn-primary">Go Back!</button></a>
      <br>
      <br> 

      @if(session()->has('messages'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('messages') }}
        </div>
	  @endif

      @foreach ($results as $result)
      <div class="panel panel-default">
        <div class="panel-body">

	  <h3>
	    {{ $result->p_title }}
	  </h3>
              @if ($result->p_cat == 1)
              <h4><span class="label label-info">Rule Violation</span></h4>

              @elseif ($result->p_cat == 2)
              <h4><span class="label label-info">Weird Moment</span></h4>

              @elseif ($result->p_cat == 3)
              <h4><span class="label label-info">Damage Somewhere</span></h4>

              @elseif ($result->p_cat == 4)
              <h4><span class="label label-info">Event/Incident/Happening</span></h4>
	
              @elseif ($result->p_cat == 5)
              <h4><span class="label label-info">Precious Moment</span></h4>

              @elseif ($result->p_cat == 6)
              <h4><span class="label label-info">Global Information</span></h4>
	      @endif	
	  <hr>
	  <img style="width: 100%;" src="/database/pictures/stream_{{ $result->p_cat }}/{{ $result->p_imgurl }}" />
	  <hr>
	  
	  <?php
	  $p_ouser = $result->p_ouser;
	  ?>
	  
	  @if ($result->p_ouser == 'anon')
	  <p>By Anonymous Poster at {{ $result->created_at }}</p>
	  @else
          <p>By <a href="/profile/{{ $result->p_ouser  }}">{{ $result->p_ouser }}</a> at {{ $result->created_at }}</p>
	  @endif

	  <h4>{{ $result->p_caption }}</h4>
          <hr>
          <h4>Rating: {{ $result->p_rating }}</h4>
        </div>
      </div>
      @endforeach
      
      <div class="panel panel-default">
        <div class="panel-body">
		  
		  @if (count($errors) > 0)
	        <div class="alert alert-danger">
	          <strong>Whoops!</strong> There were some problems with your input.<br><br>
	          <ul>
	            @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	            @endforeach
	          </ul>
	        </div>
	      @endif
		  
		  <form class="form-horizontal" role="form" method="POST" action="{{ url('/stream/detail') }}" enctype="multipart/form-data">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    <input type="hidden" name="p_id" value="{{ $p_id }}">
		    <input type="hidden" name="p_cat" value="{{ $p_cat }}">
            <input type="hidden" name="p_ouser" value="{{ $p_ouser }}">
	        
		    <div class="form-group">
	          <div class="col-md-12">
	            <label for="favor">Give taste to your comment</label>
	            <select class="form-control" name="favor" id="favor">
		          <option>Normal</option>
		          <option>Like</option>
			      <option>Dislike</option>
			      <option>Judge</option>
			      <option>Pitty</option>
			      <option>Excited</option>
			      <option>Sad</option>
			      <option>Confused</option>
		        </select>
	          </div>
	        </div>
		    
		    <div class="form-group">
	          <div class="col-md-12">
	            <label for="comment">Comment</label>
	            <textarea type="text" class="form-control" name="comment" id="comment" rows="3"></textarea>
	          </div>
	        </div>
	        
	        <div class="form-group">
	          <div class="col-md-12">
	            <button style="width: 100%;" type="submit" class="btn btn-primary">Submit</button>
	          </div>
	        </div>
		  </form>
		  
		  <hr>
		  
		  @foreach($results_2 as $result_2)
		  <div class="media">
            <div class="media-left media-top">
              <a href="/profile/{{ $result_2->c_ouser }}">
				@if ($result_2->avatar == '0')
                <img style="width: 64px; height:64px;" src="/database/pictures/avatars/def.jpg" alt="{{ $result_2->c_ouser }}">
                @else
                <img style="width: 64px; height:64px;" src="/database/pictures/avatars/{{ $result_2->avatar }}" alt="{{ $result_2->c_ouser }}">
                @endif
              </a>
            </div>
            
            <div class="media-body">
              <h4 class="media-heading">{{ $result_2->c_ouser }}</h4>
                <p style ="text-align: justify;">{{ $result_2->c_comment }}</p>
                <p> <span class="label label-success">{{ $result_2->c_favor}} on {{ $result_2->created_at}}</span></p>	
                
            </div>
          </div>
          @endforeach          
			
		</div>
	  </div>
	  
	  
    </div>
  </div>
</div>
@endsection

