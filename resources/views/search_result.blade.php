@extends('layouts.app')
@section('style')
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
@endsection
@section('content')
<table>
  <tr>
    <th>Name</th>
    <th>Type</th>
    <th>Description</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Action</th>
  </tr>
  @foreach($result as $result)
  <tr>
    @if($type == 'Station')
    <td><a href="{{route('station_profile', ['id' => $result->id])}}">{{$result->station_name}}</a></td>
    @else
    <td><a href="{{route('transport_profile', ['id' => $result->id])}}">{{$result->transport_name}}</a></td>
    @endif
    @if($type == 'Station')
    <td>{{$result->station_type}}</td>
    @else
    <td>{{$result->transport_type}}</td>
    @endif
    @if($type == 'Station')
    <td>{{$result->station_description}}</td>
    @else
    <td>{{$result->transport_description}}</td>
    @endif
    @if($type == 'Station')
    <td>{{$result->station_likes}}</td>
    @else
    <td>{{$result->transport_likes}}</td>
    @endif
    @if($type == 'Station')
    <td>{{$result->station_dislikes}}</td>
    @else
    <td>{{$result->transport_dislikes}}</td>
    @endif
    @if($type == 'Station')
    <td>  <a href="{{route('give_feedback',['id' => $result->id, 'given_to' => 'Station'])}}"><button type="button" class="btn btn-primary">Give Feedback</button></a></td>
    @else
    <td>  <a href="{{route('give_feedback',['id' => $result->id, 'given_to' => 'Transport'])}}"><button type="button" class="btn btn-primary">Give Feedback</button></a></td>
    @endif

  </tr>
  @endforeach
</table>
@endsection
<style>
.py-4 {

padding-left: 10%;
padding-right: 10%;

}
</style>