@extends('app')

@section('content')
<title>Login</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">

	<!-- FUNCTION -->
	<h3><span class="label label-info">Login</span></h3>
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

	<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">


	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="email">E-Mail Address</label>
	      <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" onChange="javascript:this.value=this.value.toLowerCase();">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label>Password</label>
	      <input type="password" class="form-control" name="password" id="password">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <div class="checkbox">
		<label><input type="checkbox" name="remember"> Remember Me</label>
	      </div>
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <button style="width: 100%;" type="submit" class="btn btn-primary">Login</button>
	    </div>
	  </div>

	  <hr>

	  <div class="form-group">
	    <div class="col-md-12">
	      <a style="width: 100%;" class="btn btn-primary" href="{{ url('/auth/register') }}">Don't have an account?</a>
	      <a style="width: 100%;" class="btn btn-danger" href="{{ url('/password/email') }}">Forgot Your Password?</a>
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
