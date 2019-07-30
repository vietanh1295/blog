@extends('layouts.app')
@section('content')
<table id="dtMaterialDesignExample" class="table">
  <thead>
    <tr>
      <th>Title</th>
      <th>Body<th>
    </tr>
  </thead>
  <tbody>
    @if($articles && count($articles)>0)
    @foreach($articles as $article)
    <tr>
      <td>{{$article->title}}</td>
      <td>{{$article->body}}</td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
<!-- <script>

  $('#dtMaterialDesignExample').DataTable();

</script> -->
@endsection
