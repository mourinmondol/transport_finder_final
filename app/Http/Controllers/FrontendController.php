<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class FrontendController extends Controller
{
    public function index()
    {
        $stations = DB::table('stations')->get();
        return view('welcome',compact('stations'));
    }

    public function search()
    {
        return view('search');
    }

    public function about()
    {
        return view('about');
    }

    public function docs()
    {
        return view('docs');
    }
    public function contact()
    {
        return view('contact');
    }
    public function transport_profile()
    {
        $transport = DB::table('transports')->where('id',$_REQUEST['id'])->first();
        $result = DB::table('routes')->where('route_TID',$_REQUEST['id'])->get();
        return view('transport_profile',compact('transport','result'));
    }
    public function station_profile()
    {
        $station = DB::table('stations')->where('id',$_REQUEST['id'])->first();
        $result = DB::table('routes')->where('route_SSID',$_REQUEST['id'])->orwhere('route_DSID',$_REQUEST['id'])->get();
        return view('station_profile',compact('result','station'));
    }
    public function search_route()
    {
        $route_SSID = $_REQUEST['route_SSID'];
        $route_DSID = $_REQUEST['route_DSID'];
        $result = DB::table('routes')->where('route_SSID',$_REQUEST['route_SSID'])->where('route_DSID',$_REQUEST['route_DSID'])->get();
        return view('search_route',compact('result','route_DSID','route_SSID'));
    }
    public function search_result()
    {
        $type = $_REQUEST['type'];
        $searchValue = $_REQUEST['searchValue'];
        if($type == 'Station'){
            $result = DB::table('stations')->where('station_name', 'like', '%' . $searchValue . '%')->get();
        }else if($type == 'Transport'){
            $result = DB::table('transports')->where('transport_name', 'like', '%' . $searchValue . '%')->get();
        }else{
            $result = DB::table('transports')->where('transport_type',$type)->where('transport_name', 'like', '%' . $searchValue . '%')->get();
        }
        return view('search_result',compact('result','searchValue','type'));
    }
  
}
