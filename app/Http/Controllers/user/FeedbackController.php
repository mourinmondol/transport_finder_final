<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use File;
Use Session;
use Auth;
class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $userId = Auth::id();
        $feedbacks = DB::table('feedbacks')->where('given_by',$userId)->simplePaginate(10);
        $stations = DB::table('stations')->get();
        $transports = DB::table('transports')->get();
        return view('user.feedback',compact('feedbacks'));
    }

    public function destroy($id)
    {
        DB::table('feedbacks')->delete($id);
        Session::flash('success','Feedback deleted');            
        return redirect()->back();
    }
    public function give_feedback()
    {
        return view('give_feedback');
    }
    public function store_feedback(Request $request)
    {
        $this->validate($request,[
            'feedback_type'=>'required',
            'feedback_comment'=>'nullable',
        ]);
        $feedback_type = $request->input('feedback_type');
        $feedback_comment = $request->input('feedback_comment');
        $given_by = $request->input('given_by');
        $given_to = $request->input('given_to');
        $given_to_id = $request->input('given_to_id');
        if($given_to == 'Transport'){
            $transport=DB::table('transports')->where('id', $given_to_id)->first();
            if($transport->transport_dislikes >=20){
                DB::table('transports')->delete($given_to_id);
            }else{
                if($feedback_type == '1'){
                    DB::table('transports')->where('id', $given_to_id)->update(['transport_likes' => $transport->transport_likes+1]);
                }else{
                   
                        DB::table('transports')->where('id', $given_to_id)->update(['transport_dislikes' => $transport->transport_dislikes+1]);
                    
                }
            }
        }else if($given_to == 'Station'){
            $station=DB::table('stations')->where('id', $given_to_id)->first();
            if($station->station_dislikes >=20){
                DB::table('stations')->delete($given_to_id);
            }else{
                if($feedback_type == '1'){
                    DB::table('stations')->where('id', $given_to_id)->update(['station_likes' => $station->station_likes+1]);
                }else{
                
                        DB::table('stations')->where('id', $given_to_id)->update(['station_dislikes' => $station->station_dislikes+1]);
                    
                }
            }
           
        }else{
            $route=DB::table('routes')->where('id', $given_to_id)->first();
            if($route->route_dislikes >=20){
                DB::table('feedbacks')->delete($given_to_id);
            }else{
                if($feedback_type == '1'){
                    DB::table('routes')->where('id', $given_to_id)->update(['route_likes' => $route->route_likes+1]);
                }else{
        
                        DB::table('routes')->where('id', $given_to_id)->update(['route_dislikes' => $route->route_dislikes+1]);
                 
                }
            }
        }
      
        $data=array('feedback_type' => $feedback_type, 'feedback_comment' => $feedback_comment, 'given_by' => $given_by, 'given_to' => $given_to, 'given_to_id' => $given_to_id);
        DB::table('feedbacks')->insert($data);
        $request->session()->flash('alert-success', 'Feedback successful added!');
        return redirect()->back();
    }
}
