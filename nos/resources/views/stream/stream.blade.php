@extends('app')

@section('content')



<div class="scroll">
    @foreach ($data as $post)
    <h3>Page 1</h3>
    <p>{{ $post->name }}</p>
    @endforeach
    <a href="/stream?page=2"></a>
</div>


<script type="text/javascript">
$('.scroll').jscroll();
</script>

@endsection
