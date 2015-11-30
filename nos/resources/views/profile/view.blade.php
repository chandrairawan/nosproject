@extends('app')

@section('content')
<title>View Profile</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">
			
		  <br>
		  
		  <div style="text-align: center;">
		  @foreach ($results as $result)
		  
			@if ($result->avatar == '0')
			<img style="width: 50%;" src="/database/pictures/avatars/def.jpg" class="img-circle" alt="{{ $result->name }}"> 
			@else
			<img style="width: 50%;" src="/database/pictures/avatars/{{ $result->avatar }}" class="img-circle" alt="{{ $result->name }}"> 
			@endif
		  
		    <br>
		    <h2>{{ $result->full_name }}</h2>
		    <h3><span class="label label-info">{{ $result->department }}</span></h3>
		    <hr>
		    <h4><b>{{ $result->email }}</b> / {{ $result->name }}</h4>
		    <h4>{{ $result->gender}}</h4>
		    <hr>
		  
		    @if($result->bio == '0')
		    <h4 style="text-align:justify;"><em>User has not written any bio.</em></h4>
		    @else
		    <h4 style="text-align:justify;">{{ $result->bio }}</h4>
		    @endif
		  @endforeach
		  </div>
		  
		  
		  @if($result->name == Auth::user()->name)
		  <hr>
		  <a style="width: 100%;" class="btn btn-primary" href="{{ url('/profile/edit') }}">Edit Profile</a>
		  
		  @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
