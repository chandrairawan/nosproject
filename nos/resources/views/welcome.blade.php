@extends('app')

@section('content')

<title>Welcome to Nos</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">

	<!-- FUNCTION -->
	<h3><span class="label label-info">Welcome to Nos</span></h3>
	<hr>

	<h1>See, Capture, Share.</h1>
	<br>

	<h4><em><b>See something strange around you? Good.</b></em></h4>
	<p><img style="width:100%;" src="{{ asset('/files/images/see_act.jpg') }}" alt="see" class="img-thumbnail"></p>
	<br>
	<h4><em><b>Do you like to capture the moment? Okay.</b></em></h4>
	<p><img style="width:100%;" src="{{ asset('/files/images/capture_act.jpg') }}" alt="capture" class="img-thumbnail"></p>
	<br>
	<h4><em><b>Share it then!</b></em></h4>
	<p><img style="width:100%;" src="{{ asset('/files/images/share_act.jpg') }}" alt="share" class="img-thumbnail"></p>
	<hr>

	<h1>Designed for.</h1>
	<br>
	<img style="width:20%;" src="{{ asset('/files/images/ft_for.png') }}" alt="Falkultas Teknik">
	<img style="width:20%;" src="{{ asset('/files/images/ui_for.png') }}" alt="Universitas Indonesia">
	<hr>
	<h4>To use Nos, you must accept the Terms and Condition</h4>	
	
	@foreach($results as $result)
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  <div class="panel panel-primary">
	    <div class="panel-heading" role="tab" id="headingOne">
	      <h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
		  Terms and Conditions
		</a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	      <div class="panel-body">
		    {!! $result->app_terms !!}
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-primary">
	    <div class="panel-heading" role="tab" id="headingTwo">
	      <h4 class="panel-title">
		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		  User Agreements
		</a>
	      </h4>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	      <div class="panel-body">
		    {!! $result->app_agree !!}
		  </div>
	    </div>
	  </div>
	  <div class="panel panel-primary">
	    <div class="panel-heading" role="tab" id="headingThree">
	      <h4 class="panel-title">
		<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		  Privacy Policy
		</a>
	      </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	      <div class="panel-body">
	        {!! $result->app_policy !!}
	      </div>
	    </div>
	  </div>
	</div>	
	@endforeach
	<hr>

	  <a style="width: 100%;" class="btn btn-primary" href="{{ url('/auth/login') }}">Login</a>
	  <a style="width: 100%;" class="btn btn-primary" href="{{ url('/auth/register') }}">Don't have an account?</a>

	<!-- ENDFUNCTION -->

        </div>
      </div>
    </div>
  </div>
</div>

@endsection

