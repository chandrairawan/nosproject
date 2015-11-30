<!
Author: Taufiq bahruddin (Taufiky@gmail.com)
Desc: HTML page for NOS User Suspend.
->

@extends('app')

@section('content')
<title>Suspend User</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">
			


	<!-- FUNCTION -->
	<h3><span class="label label-info">Suspend a User</span></h3>
	<hr>
	
	<!if it has messages->
    @if(session()->has('messages'))
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session('messages') }}
      </div>
	@endif

	<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/suspend') }}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="name">Username (case sensitive)</label>
	      <input type="text" class="form-control" name="name" id="name" autocomplete="off">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <button style="width: 100%;" type="submit" class="btn btn-primary">Submit</button>
	    </div>
	  </div>
	</form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
