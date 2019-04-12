@extends('layouts.app')
@section('style')
<script language="javascript" type="text/javascript">

    var map;
    var geocoder;
    function InitializeMap() {

        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
    }

    function FindLocaiton() {
        geocoder = new google.maps.Geocoder();
        InitializeMap();

        var address = document.getElementById("addressinput").value;
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

            }
            else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });

    }


    function Button1_onclick() {
        FindLocaiton();
    }

    window.onload = InitializeMap;

</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>

.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size:16px;
}

.fb-image-profile
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%; 
}
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
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
<div class="main">
<!-- <table>
<tr>
<td>
    <input id="addressinput" type="text" style="width: 447px" />   
</td>
<td>
    <input id="Button1" type="button" value="Find" onclick="return Button1_onclick()" /></td>
</tr>
<tr>
<td colspan ="2">
<div id ="map" style="height: 253px" >
</div>
</td>
</tr>
</table> -->
<br>
<div class="fb-profile">
<div style="width: 100%; padding-left: 10%;

padding-right: 10%;"><img width="100%"  height="300" src="{{asset('uploads/'.$station->station_image)}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></div><br />
     
      
        <div class="fb-profile-text">
            <h1>{{$station->station_name}}<small> {{$station->station_type}}</small></h1>
            <p>{{$station->station_description}}</p>
        </div>
         <a href="{{route('give_feedback',['id' => $_GET['id'], 'given_to' => 'Station'])}}"><button type="button" class="btn btn-primary">Give Feedback</button></a>
    </div>

<table>
  <tr>
    <th>Transport Name</th>
    <th>Type</th>
    <th>Description</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Action</th>
  </tr>
  @foreach($result as $result)
  <tr>
    <td>@php
        $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
        echo $transport->transport_name;
        @endphp
    </td>
    <td>@php
        $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
        echo $transport->transport_type;
        @endphp</td>
    <td>@php
        $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
        echo $transport->transport_description;
        @endphp</td>
    <td>@php
        $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
        echo $transport->transport_likes;
        @endphp</td>
    <td>@php
        $transport = App\Http\Controllers\FeedbackController::getBus($result->route_TID);
        echo $transport->transport_dislikes;
        @endphp</td>
    <td>  <a href="{{route('give_feedback',['id' => $result->id, 'given_to' => 'Station'])}}"><button type="button" class="btn btn-primary">Give Feedback</button></a></td>
  </tr>
  @endforeach
</table>
@endsection