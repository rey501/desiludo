<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Commission;
use App\User_Data;
use App\Games;
use App\Trans;
use App\Orders;
use App\Brokerages;
use App\Issues;
use App\Tournament;
use App\Bots;
use App\Withdraws;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } */
    public function index()
    { 
        return view('auth.login');        
    }
    public function login(Request $request){

        $data = User::where('email', '=', $request->email)->where('password','=',$request->password)->get();
        if ($data!=null && sizeof($data) >0) {
            
            $udata = Tournament::all()->count();
        
            $odata = Bots::all()->count();
            $userdata = User_Data::all()->count();
            $loginuserdata = User_Data::all()->where("isLogin",1)->count();
            $subadmindata = User_Data::all()->where("isSubAdmin","true")->count();
            $walletdata = User_Data::all()->sum("points");
            $commissiondata = Commission::all()->sum("commission");
    
            $deativatedata = User_Data::all()->where("isActive","false")->count();
           
            $offlineuserdata=$userdata-$loginuserdata;
    
            $orderdata = Orders::where('status','success')->sum('amount');
            
            $sdata = Withdraws::where('status','success')->sum('amount');
            $pdata = Withdraws::where('status','pending')->sum('amount');
            $cdata = Withdraws::where('status','cancel')->sum('amount');

            $request->session()->put('admin', '1');
            $request->session()->put('adminid', $data[0]->_id);
            $request->session()->put('adminname', $data[0]->adminname);
            $request->session()->put('adminemail', $data[0]->email);
    
            return view('dashboard',['udata'=>$udata,
                                    'odata'=>$odata,
                                    'userdata'=>$userdata,
                                    'loginuserdata'=>$loginuserdata,
                                    'offlineuserdata'=>$offlineuserdata,
                                    'deativatedata'=>$deativatedata,
                                    'subadmindata'=>$subadmindata,
                                    'walletdata'=>$walletdata,
                                    'orderdata'=>$orderdata,
                                    'sdata'=>$sdata,
                                    'pdata'=>$pdata,
                                    'cdata'=>$cdata,
                                    'commissiondata'=>$commissiondata
                                ]);

            /* $udata = Tournament::all()->count();
            $odata = Bots::all()->count();
            $userdata = User_Data::all()->count();
            $loginuserdata = User_Data::all()->where("isLogin",1)->count();
            $subadmindata = User_Data::all()->where("isSubAdmin","true")->count();
            $walletdata = User_Data::all()->sum("points");
            $commissiondata = Commission::all()->sum("commission");

            $orderdata = Orders::where('status','success')->sum('amount');
            $sdata = Withdraws::where('status','success')->sum('amount');
            $pdata = Withdraws::where('status','pending')->sum('amount');
            $cdata = Withdraws::where('status','cancel')->sum('amount');

            $request->session()->put('admin', '1');
            $request->session()->put('adminid', $data[0]->_id);
            $request->session()->put('adminname', $data[0]->adminname);
            $request->session()->put('adminemail', $data[0]->email);

            return view('dashboard',["data"=> $data,
                                'userdata'=>$userdata,
                                'loginuserdata'=>$loginuserdata,
                                'subadmindata'=>$subadmindata,
                                'walletdata'=>$walletdata,
                                'orderdata'=>$orderdata,
                                'sdata'=>$sdata,
                                'pdata'=>$pdata,
                                'cdata'=>$cdata,
                                'udata'=>$udata,
                                'odata'=>$odata,
                                'commissiondata'=>$commissiondata]); */
            
        }else{
            return view('auth.login',['error'=>"Invalide Email/password"]);
        }
        
       
    }
}
