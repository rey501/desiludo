<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bots;


class BotsController extends Controller
{
    public function index()
    {
        $data = Bots::all();
        return view('bots.view_bots',['data'=>$data]);
    }

    public function edit($id)
    {
        $data = Bots::findOrFail($id);
        return view('bots.edit_bots',['edata'=>$data]);
    }

    public function update(Request $request, $id)
    {

    	// echo "<pre>";
    	// print_r($request->toArray());
    	// die;
		$data = Bots::findOrFail($id);
    	if($request->status == "true"){
	        $data->is_available = "true";
			$data->bet = $request->bet;
			//$data->winratio = $request->winratio;
	        $data->game_type = $request->game_type;
	        $data->status = "true";
	     //    echo "<pre>";
	    	// print_r($data->toArray());
	    	// die;
    	}else{
    		$data->is_available = "false";
	        $data->bet = 0;
			$data->game_type = 0;
			//$data->winratio = $request->winratio;
	        $data->status = $request->status;
	     //    echo "<pre>";
	    	// print_r($data->toArray());
	    	// die;
    	}
	    $data->save();
        return redirect('/bots');
    }

}
