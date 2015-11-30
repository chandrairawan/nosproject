<!
Author: Taufiq bahruddin (Taufiky@gmail.com)
Desc: HTML page for NOS Content Moderation.
->

@extends('app')

@section('content')
<title>Content Moderation</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <a href="{{ url('/admin/moderation') }}"><button style="width: 100%;" type="submit" class="btn btn-primary">Refresh</button></a>
      <br>
      <br> 
      
	  <!if it has messages->
      @if(session()->has('messages'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('messages') }}
        </div>
      @endif

      @foreach ($results as $result)
      <div class="panel panel-default">
        <div class="panel-body">

	  <h4>
	    {{ $result->p_title }}
	  </h4>
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
	  <a href="#"><img style="width: 100%;" src="/database/pictures/stream_{{ $result->p_cat }}/{{ $result->p_imgurl }}" /></a>
	  <hr>
	  
	  @if ($result->p_ouser == 'anon')
	    <p>By Anonymous Poster at {{ $result->created_at }}</p>
	  @else
        <p>By <a href="#">{{ $result->p_ouser }}</a> at {{ $result->created_at }}</p>
	  @endif

	  <h4>{{ $result->p_caption }}</h4>
          <hr>
          <a href="/admin/moderation/{{ $result->p_id }}/approve"><button style="width: 100%;" type="submit" class="btn btn-primary">Approve</button></a>
          <a href="/admin/moderation/{{ $result->p_id }}/deny"><button style="width: 100%;" type="submit" class="btn btn-danger">Deny</button></a>
          
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
