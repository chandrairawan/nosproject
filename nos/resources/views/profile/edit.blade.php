@extends('app')

@section('content')
<title>Edit Profile</title>
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
		    
		    </div>
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
			    
		    <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/edit') }}" enctype="multipart/form-data">
	          <input type="hidden" name="_token" value="{{ csrf_token() }}">
	          <input type="hidden" name="avatar_path" value="{{ $result->avatar }}">

	          <label for="avatar">Upload Avatar</label>
	            <input name="avatar" id="input-0" class="file" type="file" data-max-file-size="800" allowed-file-extension="jpg" >
			  <br>
	          <div class="form-group">
	            <div class="col-md-12">
	              <label for="bio">Bio</label>
	              <textarea type="text" class="form-control" name="bio" id="bio" rows="3">{{ $result->bio }}</textarea>
	            </div>
	          </div>
	          
	          <hr>
	          <div class="form-group">
	            <div class="col-md-12">
	              <button style="width: 100%;" type="submit" class="btn btn-primary">Save</button>
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
