<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\User_Data;
use App\Games;
use App\Trans;
use App\Orders;
use App\Brokerages;
use App\Issues;
use App\Withdraws;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class ClearDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('admin.view_data');
    }
    public function clearData(Request $request){
        $clearData=$request->clearData;
        if($clearData=="true"){
            $data = User_Data::all();
            $data->each(function($user) // foreach($posts as $post) { }
            {
                $dataUser = User_Data::find($user->_id);
                $online_multiplayer = array("played"=> 0, "won"=> 0 );
                $friend_multiplayer = array("played"=> 0, "won"=> 0 );
                $tokens_captured =array("mine"=> 0, "opponents"=> 0 );
                $won_streaks =array("current"=> 0, "best"=> 0 );

                $dataUser->online_multiplayer = $online_multiplayer;
                $dataUser->friend_multiplayer = $friend_multiplayer;
                $dataUser->tokens_captured = $tokens_captured;
                $dataUser->won_streaks = $won_streaks;
                $dataUser->level = 0;
                $dataUser->save();
            });
            /* foreach($data as $user){
                
            } */
        }
        $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();
       
        return view('admin.view',['data'=>$data]);
    }
    
}
