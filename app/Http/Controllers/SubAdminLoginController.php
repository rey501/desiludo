<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Commission;
use App\User_Data;
use App\SubAdmin_Page;
use App\Games;
use App\Trans;
use App\Orders;
use App\Brokerages;
use App\Issues;
use App\Withdraws;
use App\Tournament;
use App\Bots;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class SubAdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sub_admin.sub_admin_login',['error'=>0]);
    }


    public function sub_admin_login(Request $request)
    {

        $data = SubAdmin_Page::where('isActive','true')
            ->where("email",$request->email)
            ->where("password",$request->password)
            ->first();
      
        if($data!=null || $data!=''){
            $request->session()->put('subadmin', '1');
            $request->session()->put('subadminid', $data->_id);
            $request->session()->put('subadminname', $data->adminname);
            $request->session()->put('subadminemail', $data->email);

            $request->session()->put('userPage', $data->userPage);
            $request->session()->put('commissionPage', $data->commissionPage);
            $request->session()->put('tournamentPage', $data->tournamentPage);
            $request->session()->put('botsPage', $data->botsPage);
            $request->session()->put('moneyPage', $data->moneyPage);
            $request->session()->put('cleardataPage', $data->cleardataPage);


            $userdata = User_Data::where("subAdminId",$data->_id)->count();
            $loginuserdata = User_Data::where("subAdminId",$data->_id)->where("isLogin",1)->count();
           
            $deativatedata = User_Data::all()->where("subAdminId",$data->_id)->where("isActive","false")->count();
        
            $offlineuserdata=$userdata-$loginuserdata;

            $walletdata = User_Data::where("subAdminId",$data->_id)->sum("points");
            $totalAmount=0;
            $dataCom = Commission::all();
            foreach($dataCom as $com){
                
                $userInfo = User_Data::where("_id",$com['winneruser'])->where("subAdminId",$data->_id)->first();
                $subCommissionPer=SubAdmin_Page::where("_id",$data->_id)->first();
                $totalAmount += (($com['commission']*$subCommissionPer->commission)/100); 

            }

            $commissiondata =  $totalAmount;

            $orderdata = Orders::where('status','success')->sum('amount');
            $sdata = Withdraws::where('status','success')->sum('amount');
            $pdata = Withdraws::where('status','pending')->sum('amount');
            $cdata = Withdraws::where('status','cancel')->sum('amount');

            /* return view('dashboard',['udata'=>$udata,
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
                            ]); */
            return view('dashboard',['error'=>'0',
                                    'udata'=>0,
                                    'odata'=>0,
                                    'userdata'=>$userdata,
                                    'loginuserdata'=>$loginuserdata,
                                    'offlineuserdata'=>$offlineuserdata,
                                    'deativatedata'=>$deativatedata,
                                    'subadmindata'=>1,
                                    'walletdata'=>$walletdata,
                                    'orderdata'=>$orderdata,
                                    'sdata'=>$sdata,
                                    'pdata'=>$pdata,
                                    'cdata'=>$cdata,
                                    'data'=>$data,
                                    'commissiondata'=>$commissiondata
                                ]);
           
        }else{
           
            return view('sub_admin.sub_admin_login',['error'=>1,'message'=>"Invalide Subadmin id/password"]);
        }
       
        
    }

}
