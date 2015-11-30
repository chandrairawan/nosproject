@extends('app')

@section('content')
<title>Register</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">

	<!-- FUNCTION -->
	<h3><span class="label label-info">Register</span></h3>
	<hr>
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

	<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="name">Full Name</label>
	      <input type="text" class="form-control" name="full_name" id="full_name" value="{{ old('full_name') }}">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="name">Gender</label>
	      <select class="form-control" name="gender" id="gender">
		    <option>Male</option>
			<option>Female</option>
		  </select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="department">Department</label>
	      <select class="form-control" name="department" id="department">
		    <option>Civil Engineering</option>
			<option>Mechanical Engineering</option>
			<option>Industrial Engineering</option>
			<option>Electrical Engineering</option>
			<option>Chemical Engineering</option>
			<option>Metallurgical Engineering</option>
			<option>Architecture</option>
		  </select>
	    </div>
	  </div>

      <hr>
	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="name">Username</label>
	      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" onChange="javascript:this.value=this.value.toLowerCase();">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="email">E-Mail Address</label>
	      <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" onChange="javascript:this.value=this.value.toLowerCase();">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="password">Password</label>
	      <input type="password" class="form-control" name="password"  id="password" >
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="password_confirmation">Confirm Password</label>
	      <input type="password" class="form-control" name="password_confirmation"  id="password_confirmation" >
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <button style="width: 100%;" type="submit" class="btn btn-primary">Register</button>
	    </div>
	  </div>
	  
	  <hr>

	  <div class="form-group">
	    <div class="col-md-12">
	      <a style="width: 100%;" class="btn btn-primary" href="{{ url('/auth/login') }}">I Already Have an Account.</a>
	      <a style="width: 100%;" class="btn btn-danger" href="{{ url('/') }}">Go Back!</a>
	    </div>
	  </div>
	</form>
	<!-- ENDFUNCTION -->

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
