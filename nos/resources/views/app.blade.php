<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS -->
  <link href="{{ asset('/css/app_2.css') }}" rel="stylesheet">
  <!-- Scripts -->
  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/js/scroll.min.js') }}"></script>
  <script src="{{ asset('/js/filein.min.js') }}"></script>
</head>
<body>

  @yield('content')

</body>
<footer>


  @if (Auth::user())
  <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/auth/home') }}">Nos</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ url('/profile/inbox') }}"><span class="glyphicon glyphicon-bell"></span></a></li>	
		  <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
          <li><a href="#">My Posts</a></li>
          <li><a href="/profile/{{ Auth::user()->name}}">My Profile</a></li>
          <li><a href="{{ url('/publish') }}">Make Publication</a></li>
          @if (Auth::user()->admin == true)
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="label label-warning">Admin</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/admin/moderation') }}">Moderation</a></li>
              <li><a href="{{ url('/admin/suspend') }}">Suspend</a></li>
              <li><a href="{{ url('/admin/unsuspend') }}">Unsuspend</a></li>
              <li><a href="{{ url('/admin/privilege') }}">Give Admin Privilege To</a></li>
              <li><a href="{{ url('/admin/application') }}">Application Information State</a></li>
              <li><a href="{{ url('/admin/report') }}">Reports</a></li>
            </ul>
          </li>
          @endif
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="label label-info">Categories</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Rule Violation</a></li>
              <li><a href="#">Weird Moment</a></li>
              <li><a href="#">Damage Somewhere</a></li>
              <li><a href="#">Event/Incident/Happening</a></li>
              <li><a href="#">Precious Moment</a></li>
              <li><a href="#">Global Information</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @endif


</footer>
</html>
