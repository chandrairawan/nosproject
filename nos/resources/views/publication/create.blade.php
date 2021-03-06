<!
Author: Taufiq bahruddin (Taufiky@gmail.com)
Desc: HTML page for NOS publishing.
->

@extends('app')

@section('content')
<title>Publish a Content</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default" style="background-color: whitesmoke;">
        <div class="panel-body">

	<!-- FUNCTION -->
	<h3><span class="label label-warning">Publish a content</span></h3>
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


	<form class="form-horizontal" role="form" method="POST" action="{{ url('/publish/record') }}" enctype="multipart/form-data">
	  <input type="hidden" name="_token" value="{{ csrf_token() }}">

	  <h4>Upload / capture a pic</h4>

	  <input name="image" id="input-0" class="file" type="file" value="Choose Photo" data-min-file-count="1" data-max-file-size="1200" allowed-file-extension="jpg">
    
	<hr>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="title">Category</label>
	      <select name="category" id="category" class="form-control">
	        <option value="1">Rule Violation</option>
	        <option value="2">Weird Moment</option>
	        <option value="3">Damage Somewhere</option>
	        <option value="4">Event/Incident/Happening</option>
	        <option value="5">Precious Moment</option>
	        <option value="6">Global Info</option>
	      </select>
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="title">Title</label>
	      <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <label for="caption">Caption</label>
	      <textarea type="text" class="form-control" name="caption" id="caption" value="{{ old('caption') }}" rows="3"></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-md-12">
	      <div class="checkbox">
		    <label><input type="checkbox" name="anon" value="1">Publish anonymously</label>
	      </div>
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-md-12">
	      <button style="width: 100%;" type="submit" class="btn btn-primary">Publish</button>
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
