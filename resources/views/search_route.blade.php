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
<h2>All Available Transports from  @php
                                $results = App\Http\Controllers\FeedbackController::getStation($route_SSID);
                                echo $results->station_name;
                                @endphp To  @php
                                $results = App\Http\Controllers\FeedbackController::getStation($route_DSID);
                                echo $results->station_name;
                                @endphp</h2>

<table>
  <tr>
    <th>Transport Name</th>
    <th>Type</th>
    <th>Fare</th>
    <th>Distance</th>
    <th>Description</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Action</th>
  </tr>
  @foreach($result as $result)
  <tr>
    <td><a href="{{route('transport_profile',['id' => $result->route_TID])}}">@php
                                $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
                                echo $transport->transport_name;
                                @endphp</a></td>
    <td> @php
                                $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
                                echo $transport->transport_type;
                                @endphp</td>
    <td>{{$result->route_fare}}</td>
    <td>{{$result->route_distance}}</td>
    <td>{{$result->route_description}}</td>
    <td>{{$result->route_likes}}</td>
    <td>{{$result->route_dislikes}}</td>
    <td><a href="{{route('give_feedback',['id' => $result->id, 'given_to' => 'Route'])}}"><button type="button" class="btn btn-primary">Give Feedback</button></a></td>
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