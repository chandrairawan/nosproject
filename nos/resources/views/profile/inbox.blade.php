@extends('app')

@section('content')
<title>System Notification</title>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <a href="{{ URL::previous() }}"><button style="width: 100%;" type="submit" class="btn btn-primary">Go Back!</button></a>
      <br>
      <br> 

      @if(session()->has('messages'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('messages') }}
        </div>
	  @endif

      
        <div class="list-group">
	      @foreach ($results as $result)
	        @if($result->n_read == false)
              <a href="{{ $result->n_link }}" class="list-group-item active">
              <h3>{{ $result->n_message }}</h3>
              <p><em>Notification triggered by: {{ $result->n_sender }} at {{ $result->created_at }}</em></p>
              </a>
            @else
              <a href="{{ $result->n_link }}" class="list-group-item">
              <h3>{{ $result->n_message }}</h3>
              <p><em>Notification triggered by: {{ $result->n_sender }} at {{ $result->created_at }}</em></p>
              </a>
            @endif
          @endforeach
        </div>
        
    </div>
  </div>
</div>
@endsection
