<!
Author: Taufiq bahruddin (Taufiky@gmail.com)
Desc: HTML page for NOS User Suspend.
->

@extends('app')

@section('content')
<title>Application Setting</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">
			


	<!-- FUNCTION -->
	<h3><span class="label label-info">Application Setting</span></h3>
	<hr>
	
	<!if it has messages->
    @if(session()->has('messages'))
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('messages') }}
      </div>
	@endif
	
	  <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Do not try to change Application Information State without an actual Authorization!
      </div>

    @foreach($results as $result)
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/application') }}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="app_version">Application Version</label>
	      <input type="text" class="form-control" name="app_version" id="app_version" value="{{ $result->app_version }}">
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="app_info">Application Info</label>
	      <input type="text" class="form-control" name="app_info" id="app_info" value="{{ $result->app_info }}">
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="app_domain">Application Domain</label>
	      <input type="text" class="form-control" name="app_domain" id="app_domain" value="{{ $result->app_domain }}">
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="app_email">Application Official Email</label>
	      <input type="text" class="form-control" name="app_email" id="app_email" value="{{ $result->app_email }}">
	    </div>
	  </div>
	  
      <div class="form-group">
        <div class="col-md-12">
	      <label for="app_terms">Application Terms and Conditions (HTML)</label>
	      <textarea type="text" class="form-control" name="app_terms" id="app_terms" rows="3">{{ $result->app_terms }}</textarea>
	    </div>
	  </div>
	  
      <div class="form-group">
        <div class="col-md-12">
	      <label for="app_agree">Application User Agreement (HTML)</label>
	      <textarea type="text" class="form-control" name="app_agree" id="app_agree" rows="3">{{ $result->app_agree }}</textarea>
	    </div>
	  </div>
	  
      <div class="form-group">
        <div class="col-md-12">
	      <label for="app_policy">Application Privacy Policy (HTML)</label>
	      <textarea type="text" class="form-control" name="app_policy" id="app_policy" rows="3">{{ $result->app_policy }}</textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="app_notification">Application Flash Global Notification</label>
	      <input type="text" class="form-control" name="app_notification" id="app_notification" value="{{ $result->app_notification }}">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <button style="width: 100%;" type="submit" class="btn btn-primary">Submit</button>
	    </div>
	  </div>
	</form>
	@endforeach

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
