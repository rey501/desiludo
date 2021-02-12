<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tournament::all();

        return view('tournament.view_tournament',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tournament.add_tournament');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->toArray());
        // die;

       /*  $validatedData = $request->validate([
            'tournament_name' => 'required',
            'tournament_price' => 'required|not_in:-1|numeric',
        ]); */
       // $amount = $request->tournament_price * 8;
        // echo $amount;
        // die;
        if( $request->tournament_name=="" || $request->tournament_name==null ||
            $request->tournament_price=="" || $request->tournament_price==null ||
            $request->game_type=="" || $request->game_type==null ||
            $request->time_limit=="" || $request->time_limit==null ||
            $request->isActive=="" || $request->isActive==null ||
            $request->winning_amount=="" || $request->winning_amount==null
        ){
            return redirect('/tournament');
        }
        $data = new Tournament();
        $data->tournament_name = $request->tournament_name;
        $data->tournament_price = $request->tournament_price;
        $data->game_type = $request->game_type;
        $data->time_limit = $request->time_limit;
        $data->isActive = $request->isActive;
        $data->winning_amount = $request->winning_amount;
        $data->users = NUll;
        $data->save();
        return redirect('/tournament');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tournament::findOrFail($id);
        return view('tournament.edit_tournament',['edata'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tournament_name' => 'required',
            'tournament_price' => 'required|not_in:-1|numeric',
            'winning_amount' => 'required|not_in:-1|numeric',
        ]);

        $data = Tournament::findOrFail($id);
        $data->tournament_name = $request->tournament_name;
        $data->tournament_price = $request->tournament_price;

        $data->game_type = $request->game_type;
        $data->time_limit = $request->time_limit;
        $data->isActive = $request->isActive;

        $data->winning_amount = $request->winning_amount;
        $data->save();
        return redirect('/tournament');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tournament::findOrFail($id);
        $data->delete();
        return redirect('/tournament');
    }
}
