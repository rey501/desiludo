<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => [
            'users',
            'admin',
            'sub_admin',
            'tournament',
            'bots',
            'userWithdrawal',
            'money',
            'commission',
        ]]);  
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // Users::create(['id' => 1, 'title' => 'The Fault in Our Stars']);
        // $data = Users::all();
        // echo "<pre>";
        // print_r($data->toArray());
        // die;
        return view('home');
    }
}
