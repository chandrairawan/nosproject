
@extends('app')

@section('content')
<title>Arduino Controller View</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">
			


	<!-- FUNCTION -->
	<h3><span class="label label-info">Detected Motions</span></h3>
	<hr>
	
	
	@if (empty($results))
	      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        There is no entry
      </div>
	
	@else
	 <table style="width:100%" class="table table-striped">
		<tr style="text-align:left;">
			<td>Detection ID</td>
			<td>Detection Value</td>
			<td>Detection Client</td>
			<td>Detected at</td>
		</tr>
		
		
		@foreach($results as $result)
		<tr style="text-align:left;">
			<td>{{ $result->v_id }}</td>
			<td>{{ $result->v_val }}</td>
			<td>{{ $result->v_cli }}</td>
			<td>{{ $result->created_at }}</td>
		</tr>
		@endforeach
	</table> 
	@endif
	
	
		<hr>
	<a href="{{ url('/arduview2') }}"><h4><span class="label label-warning">See all entry</span></h4></a> 

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
