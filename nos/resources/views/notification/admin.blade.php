@extends('app')

@section('content')
<title>Admin Notification</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">

	<!-- FUNCTION -->
	<h3><span class="label label-warning">Admin notification</span></h3>
	<hr>
	@if(session()->has('messages'))
	
	  <h4>{{ session('messages') }}</h4>
						
	@else

	  <h4>There is no admin notification for now.</h4>

	@endif

	<hr>
	<a href="{{ url('/home') }}"><button style="width: 100%;" type="submit" class="btn btn-primary">Okay! go back to home page</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection




