@extends('layouts.app')
@section('content')
<div class="text-center" id="outPopUp">
                <h1 >Transport Finder</h1>
                <form method="GET" action="{{route('search_route')}}" class="searching">
                <select class="form-control  form-control-lg " name="route_SSID">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station_name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-lg " name="route_DSID">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-default btn-sd">Search</button>
                </form>
                </div>
@endsection
<style>
    #outPopUp {
  position: absolute;
  width: 300px;
  height: 200px;
  z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
}
    </style>