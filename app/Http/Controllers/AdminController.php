<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\User_Data;
use App\Commission;
use App\Games;  
use App\Trans;
use App\Orders;
use App\Brokerages;
use App\Tournament;
use App\Bots;
use App\Issues;
use App\Withdraws;
use Auth;
use Hash;
use Session;
use App\Histories;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\    
     */
    public function index()
    {   
        $udata = Tournament::all()->count();
        
        $odata = Bots::all()->count();
        $userdata = User_Data::all()->count();
        $loginuserdata = User_Data::all()->where("isLogin",1)->count();
        $subadmindata = User_Data::all()->where("isSubAdmin","true")->count();
        $walletdata = User_Data::all()->sum("points");
        $commissiondata = Commission::all()->sum("commission");

        $deativatedata = User_Data::all()->where("isActive","false")->count();
        $ativatedata = User_Data::all()->where('subAdminId',Session::get('subadminid'))->where("isActive","true")->count();
        $offlineuserdata=$userdata-$loginuserdata;

        $orderdata = Orders::where('status','success')->sum('amount');
        
        $sdata = Withdraws::where('status','success')->sum('amount');
        $pdata = Withdraws::where('status','pending')->sum('amount');
        $cdata = Withdraws::where('status','cancel')->sum('amount');

        return view('dashboard',['udata'=>$udata,
                                'odata'=>$odata,
                                'userdata'=>$userdata,
                                'loginuserdata'=>$loginuserdata,
                                'offlineuserdata'=>$offlineuserdata,
                                'deativatedata'=>$deativatedata,
                                'ativatedata'=>$ativatedata,
                                'subadmindata'=>$subadmindata,
                                'walletdata'=>$walletdata,
                                'orderdata'=>$orderdata,
                                'sdata'=>$sdata,
                                'pdata'=>$pdata,
                                'cdata'=>$cdata,
                                'commissiondata'=>$commissiondata
                            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin_profile');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // echo "<pre>";
        // print_r($id);
        // die;
        $id = Auth::user()->id;
        $data = User::find($id);
        if($data->type == "admin"){
            $data->name = $request->name;
            $data->email = $request->email;
        }
        $data->save();
        return redirect('/admin/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_profile(Request $request)
    {
        $validatedData = $request->validate([
            'opass' => 'required',
            'npass' => 'required',
            'cpass' => 'required',
        ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        // echo "<pre>";
        // print_r($data->password);
        // die;
     
        if(Hash::check($request->opass,$data->password))
        {
           if($request->npass == $request->cpass)  
           {
                $data->password = Hash::make($request->cpass);
                $data->save();
                Session::flush();
                Auth::logout();
                return redirect('/');
           }  
           else 
           {
           return back()->with('msg','new pass not match....');
           }
        }
        else
        {
           return back()->with('msg','old pass not match....');
        }
    }
}
