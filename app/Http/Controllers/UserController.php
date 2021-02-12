<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Commission;
use App\User_Data;
use App\SubAdmin_Page;
use App\game_commission;
use App\Games;
use App\Trans;
use App\Orders;
use App\Brokerages;
use App\Issues;
use App\Withdraws;
use App\AccountHistory;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('subadmin')){
            $data = User_Data::where('type','user')->where('subAdminId',Session::get('subadminid'))
            ->orderBy('createdAt','DESC')
            ->get();
            $subdata = SubAdmin_Page::where('isActive','true')
                    ->where("_id",Session::get('subadminid'))
                    ->first();
            Session::put('userPage', $subdata->userPage);
            Session::put('commissionPage', $subdata->commissionPage);
            Session::put('tournamentPage', $subdata->tournamentPage);
            Session::put('botsPage', $subdata->botsPage);
            Session::put('moneyPage', $subdata->moneyPage);
            Session::put('cleardataPage', $subdata->cleardataPage);


            $totalUsers = User_Data::all()->where('subAdminId',Session::get('subadminid'))->count();
            $ativatedata = User_Data::all()->where('subAdminId',Session::get('subadminid'))->where("isActive","true")->count();
            $deativatedata = User_Data::all()->where('subAdminId',Session::get('subadminid'))->where("isActive","false")->count();
            $totalUserBalance = User_Data::all()->where('subAdminId',Session::get('subadminid'))->sum("points");
            return view('admin.view',[
                                        'data'=>$data,
                                        'totalUsers'=>$totalUsers,
                                        'ativatedata'=>$ativatedata,
                                        'deativatedata'=>$deativatedata,
                                        'totalUserBalance'=>$totalUserBalance,
                                        'error'=>""
                                    ]);
           

            //return view('admin.view',['data'=>$data,'error'=>""]);
        }else{
            $data = User_Data::where('type','user')
                ->orderBy('createdAt','DESC')
                ->get();

            $totalUsers = User_Data::all()->count();
            $ativatedata = User_Data::all()->where("isActive","true")->count();
            $deativatedata = User_Data::all()->where("isActive","false")->count();
            $totalUserBalance = User_Data::all()->sum("points");
            return view('admin.view',[
                                        'data'=>$data,
                                        'totalUsers'=>$totalUsers,
                                        'ativatedata'=>$ativatedata,
                                        'deativatedata'=>$deativatedata,
                                        'totalUserBalance'=>$totalUserBalance,
                                        'error'=>""
                                    ]);
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Session::has('subadmin')){
            $subAdminData= SubAdmin_Page::where("_id",Session::get('subadminid'))->get();
            return view('admin.add_user',['subAdminData'=>$subAdminData]);
        }
        $subAdminData= SubAdmin_Page::All();
        return view('admin.add_user',['subAdminData'=>$subAdminData]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        if(Session::has('subadmin')){
            $data = User_Data::findOrfail($id);  
            $subAdminData= SubAdmin_Page::where("_id",Session::get('subadminid'))->get();
            return view('admin.useredit',['edata'=>$data,'subAdminData'=>$subAdminData]);
        }
        $data = User_Data::findOrfail($id);  
        $subAdminData= SubAdmin_Page::All();
        return view('admin.useredit',['edata'=>$data,'subAdminData'=>$subAdminData]);
    }
    public function edituser($id)
    {
        if(Session::has('subadmin')){
            $data = User_Data::findOrfail($id);  
            $subAdminData= SubAdmin_Page::where("_id",Session::get('subadminid'))->get();
            return view('admin.useredit',['edata'=>$data,'subAdminData'=>$subAdminData]);
        }
        $data = User_Data::findOrfail($id);  
        $subAdminData= SubAdmin_Page::All();
        return view('admin.useredit',['edata'=>$data,'subAdminData'=>$subAdminData]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = User_Data::findOrfail($request->id);
        $data->username = $request->name;
        $data->emailid = $request->email;
        $data->password = $request->password;
        $data->mobileno = $request->mobile;
        $oldbalace=0;
        if($request->addamount != ""){
            $oldbalace=$data->points;
            $amount = $request->addamount;
            $amount = $data->points + $amount;
            
            if($amount > 0)
                $data->points = $amount;
            else
                $data->points =0;

        }else{
            $data->points = $data->points;
        }
        $data->subAdminId = $request->subadmin;
        $data->isActive = $request->isActive;
        $data->save();

        $userSaved=User_Data::where('emailid',$request->email)
            ->first();

        $creditDebitType=1;
       
        if($request->addamount < 0){
            $creditDebitType=2;
        }
        $currentbalance=$data->points;
        $accountHistorydata = array(
            "username"=> $request->name,
            "userid"=> $userSaved->_id,
            "oldbalace"=>$oldbalace,
            "creditDebit"=> $request->amount,
            "type"=>$creditDebitType,
            "currentbalance"=>$currentbalance,
            "remark"=>"New User Created",
            
        );
        AccountHistory::insert($accountHistorydata);
        
        $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();

        $totalUsers = User_Data::all()->count();
        $ativatedata = User_Data::all()->where("isActive","true")->count();
        $deativatedata = User_Data::all()->where("isActive","false")->count();
        $totalUserBalance = User_Data::all()->sum("points");
        return view('admin.view',[
                                    'data'=>$data,
                                    'totalUsers'=>$totalUsers,
                                    'ativatedata'=>$ativatedata,
                                    'deativatedata'=>$deativatedata,
                                    'totalUserBalance'=>$totalUserBalance,
                                    'error'=>""
                                ]);
        
        //return view('admin.view',['data'=>$data,'error'=>""]);
       
    }
    public function accounthistory(){
        $data = AccountHistory::all();
        return view('admin.accounthistory',['data'=>$data,'error'=>""]);
    }
    public function commissionhistory(){
        $data = Commission::all();
        foreach($data as $winData){
            
            $userdata = User_Data::where('_id',$winData->winneruser)
                ->get();
            
            $subAdmindata = SubAdmin_Page::where('_id',$userdata[0]->subAdminId)
                ->get();
            
            $winData->username=$userdata[0]->username;
            $winData->subadminname=$subAdmindata[0]->adminname;
            
        }
        
        return view('admin.commissionhistory',['data'=>$data,'error'=>""]);
    }
    public function addNewUsers(Request $request){

        if( $request->name=="" || $request->name==null ||
            $request->email=="" || $request->email==null ||
            $request->password=="" || $request->password==null ||
            $request->mobile=="" || $request->mobile==null ||
            $request->amount=="" || $request->amount==null
        ){
            $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();

            $totalUsers = User_Data::all()->count();
            $ativatedata = User_Data::all()->where("isActive","true")->count();
            $deativatedata = User_Data::all()->where("isActive","false")->count();
            $totalUserBalance = User_Data::all()->sum("points");
            return view('admin.view',[
                                        'data'=>$data,
                                        'totalUsers'=>$totalUsers,
                                        'ativatedata'=>$ativatedata,
                                        'deativatedata'=>$deativatedata,
                                        'totalUserBalance'=>$totalUserBalance,
                                        'error'=>"Please enter all Data"
                                    ]);

            //return view('admin.view',['data'=>$data,'error'=>""]);
        }

        $userCheck = User_Data::where("emailid",$request->email)->count();

        if($userCheck == 0){
            $data = User_Data::find($request->email);
       
            $online_multiplayer = array("played"=> 0, "won"=> 0 );
            $friend_multiplayer = array("played"=> 0, "won"=> 0 );
            $tokens_captured =array("mine"=> 0, "opponents"=> 0 );
            $won_streaks =array("current"=> 0, "best"=> 0 );
            
            $randomnum = round(microtime(true) * 1000)+rand(1,9);
            $referralCode = rand(10000,999999);
            $userReffer = User_Data::where('referral_code',$referralCode)
                ->get();
           
            while($userReffer->count() > 0){
                $referralCode ="".rand($referralCode,999999);
                $userReffer = User_Data::where('referral_code',$referralCode)->get();
            }
            $date = date("Y-m-d h:i:sa"); //Current Date
            $a = new UTCDateTime(strtotime($date)*1000);
            $datetime = $a->toDateTime();
            $time=$datetime->format(DATE_ATOM);  //(example: 2005-08-15T15:52:01+00:00)

            $subAdmindata = SubAdmin_Page::where('_id',$request->subadmin)->get();
           
            if($subAdmindata[0]->amountbalance < $request->amount){

                $data = User_Data::where('type','user')
                    ->orderBy('createdAt','DESC')
                    ->get();

                $totalUsers = User_Data::all()->count();
                $ativatedata = User_Data::all()->where("isActive","true")->count();
                $deativatedata = User_Data::all()->where("isActive","false")->count();
                $totalUserBalance = User_Data::all()->sum("points");
                return view('admin.view',[
                                            'data'=>$data,
                                            'totalUsers'=>$totalUsers,
                                            'ativatedata'=>$ativatedata,
                                            'deativatedata'=>$deativatedata,
                                            'totalUserBalance'=>$totalUserBalance,
                                            'error'=>"amount must be less than subadmin balance"
                                        ]);
                //return view('admin.view',['data'=>$data,'error'=>"amount must be less than subadmin balance"]);
            }
            $subAdmindata[0]->amountbalance=$subAdmindata[0]->amountbalance-$request->amount;
            $subAdmindata[0]->save();
            

            $data = array(
                "username"=> $request->name,
                "userid"=> $randomnum,
                "emailid"=> $request->email,
                "password"=>$request->password,
                "mobileno"=>$request->mobile,
                "photo"=> "",
                "points"=> $request->amount,
                "level"=> 0,
                "online_multiplayer"=> $online_multiplayer,
                "friend_multiplayer"=> $friend_multiplayer,
                "tokens_captured"=> $tokens_captured,
                "won_streaks"=> $won_streaks,
                "referral_count"=> 0,
                "referral_users"=> [],
                "created_date"=> $time,
                "spin_date"=> $time,
                "dailyReward_date"=> $time,
                "referral_code"=> $referralCode,
                "connect"=> "",
                "type"=>"user",
                "isActive"=>"true",
                "subAdminId" => $request->subadmin,
                "created_at" => $time
            );
            User_Data::insert($data);
            
            $userSaved=User_Data::where('emailid',$request->email)
                        ->first();
            
            $accountHistorydata = array(
                "username"=> $request->name,
                "userid"=> $userSaved->_id,
                "oldbalace"=>0,
                "creditDebit"=> $request->amount,
                "type"=>1,
                "currentbalance"=>$request->amount,
                "remark"=>"New User Created",
                "date"=>$time,
                
            );
            AccountHistory::insert($accountHistorydata);


            $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();

            $totalUsers = User_Data::all()->count();
            $ativatedata = User_Data::all()->where("isActive","true")->count();
            $deativatedata = User_Data::all()->where("isActive","false")->count();
            $totalUserBalance = User_Data::all()->sum("points");
            return view('admin.view',[
                                        'data'=>$data,
                                        'totalUsers'=>$totalUsers,
                                        'ativatedata'=>$ativatedata,
                                        'deativatedata'=>$deativatedata,
                                        'totalUserBalance'=>$totalUserBalance,
                                        'error'=>""
                                    ]);
            
           // return view('admin.view',['data'=>$data,'error'=>""]);
        }else{
            $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();

            $totalUsers = User_Data::all()->count();
            $ativatedata = User_Data::all()->where("isActive","true")->count();
            $deativatedata = User_Data::all()->where("isActive","false")->count();
            $totalUserBalance = User_Data::all()->sum("points");
            return view('admin.view',[
                                        'data'=>$data,
                                        'totalUsers'=>$totalUsers,
                                        'ativatedata'=>$ativatedata,
                                        'deativatedata'=>$deativatedata,
                                        'totalUserBalance'=>$totalUserBalance,
                                        'error'=>"Failed"
                                    ]);
            //return view('admin.view',['data'=>$data,'error'=>"failed"]);
        }
        
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User_Data::findOrfail($id);
        $data->delete();

        $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();
        $totalUsers = User_Data::all()->count();
        $ativatedata = User_Data::all()->where("isActive","true")->count();
        $deativatedata = User_Data::all()->where("isActive","false")->count();
        $totalUserBalance = User_Data::all()->sum("points");
        return view('admin.view',[
                                    'data'=>$data,
                                    'totalUsers'=>$totalUsers,
                                    'ativatedata'=>$ativatedata,
                                    'deativatedata'=>$deativatedata,
                                    'totalUserBalance'=>$totalUserBalance,
                                    'error'=>""
                                ]);
        //return view('admin.view',['data'=>$data,'error'=>""]);
    }
    public function delete($id)
    {
        $data = User_Data::findOrfail($id);
        $data->delete();
        $data = User_Data::where('type','user')
            ->orderBy('createdAt','DESC')
            ->get();


        $totalUsers = User_Data::all()->count();
        $ativatedata = User_Data::all()->where("isActive","true")->count();
        $deativatedata = User_Data::all()->where("isActive","false")->count();
        $totalUserBalance = User_Data::all()->sum("points");
        return view('admin.view',[
                                    'data'=>$data,
                                    'totalUsers'=>$totalUsers,
                                    'ativatedata'=>$ativatedata,
                                    'deativatedata'=>$deativatedata,
                                    'totalUserBalance'=>$totalUserBalance,
                                    'error'=>""
                                ]);
        //return view('admin.view',['data'=>$data,'error'=>""]);
    }
    public function walletuser(){
        $data = Orders::all();
        $udata = User::all();
        return view('admin.walletuser',['data'=>$data,'udata'=>$udata]);
    }

    public function appissue(){
        $data = Issues::all();
        $udata = User::all();
        return view('admin.app_issue',['data'=>$data,'udata'=>$udata]);
    }

    public function game_done(){
        $data = Games::all();
        $udata = User::all();
        return view('admin.game_done',['data'=>$data,'udata'=>$udata]);
    }

    public function money_pending(){
        $data = Withdraws::where('status','pending')->orderBy('date', 'DESC')->get();
        $udata = User_Data::all();
       
        $resArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        $totalPendingAmount=0;
        foreach($data as $games){
            $gameDate=date_create(date("Y-m-d",strtotime($games['date']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
            
            if($diff==0){
                if($games['status'] == "pending"){
                    $todayAmount=$todayAmount+$games['amount'];
                }
            }elseif($diff>=30){
                if($games['status'] == "pending"){
                    $lastAmount = $lastAmount+$games['amount'];
                }
            }
            if($games['status'] == "pending"){
                $totalPendingAmount = $totalPendingAmount+$games['amount'];
            }
            if($games['status'] == "success"){
                $totalAmount += $games['amount'];
            }
        }
        
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        $resArray['totalPendingAmount']=number_format($totalPendingAmount,2);
        
        return view('admin.money_pending',['data'=>$data,'udata'=>$udata,'res'=>$resArray]);
    }

    public function money_done(){
        $data = Withdraws::where('status','success')->orderBy('date', 'DESC')->get();
        $udata = User_Data::all();

        $resArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        foreach($data as $games){
            $gameDate=date_create(date("Y-m-d",strtotime($games['date']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
            if($diff==0){
                $todayAmount=$todayAmount+$games['amount'];
            }elseif($diff>=30){
                if($games['status'] == "success"){
                    $lastAmount = $lastAmount+$games['amount'];
                }
            }
            if($games['status'] == "success"){
                $totalAmount += $games['amount'];
            }
        }
       
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        return view('admin.money_done',['data'=>$data,'udata'=>$udata,'res'=>$resArray]);
    }

    public function money_cancel(){
        $data = Withdraws::where('status','reject')->orderBy('date', 'DESC')->get();
        $udata = User_Data::all();

        $resArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        foreach($data as $games){
            $gameDate=date_create(date("Y-m-d",strtotime($games['date']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
            if($diff==0){
                $todayAmount=$todayAmount+$games['amount'];
            }elseif($diff>=30){
                if($games['status'] == "reject"){
                    $lastAmount = $lastAmount+$games['amount'];
                }
            }
            if($games['status'] == "reject"){
                $totalAmount += $games['amount'];
            }
        }
       
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        return view('admin.money_done',['data'=>$data,'udata'=>$udata,'res'=>$resArray]);
    }

    public function money_request_edit($id)
    {
        $data = Withdraws::findOrfail($id);
        $udata = User::findOrfail($data->user);
        return view('admin.money_request_edit',['edata'=>$data,'udata'=>$udata]);
    }
    public function money_request_approve($id)
    {
        $data = Withdraws::findOrfail($id);
        $data->status ="success";
        $data->save();

        $data = Withdraws::orderBy('date', 'DESC')->get();
        $udata = User_Data::all();
       
        $resArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        $totalPendingAmount=0;
        foreach($data as $games){
            $gameDate=date_create(date("Y-m-d",strtotime($games['date']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
            
            if($diff==0){
                if($games['status'] == "pending"){
                    $todayAmount=$todayAmount+$games['amount'];
                }
            }elseif($diff>=30){
                if($games['status'] == "pending"){
                    $lastAmount = $lastAmount+$games['amount'];
                }
            }
            if($games['status'] == "pending"){
                $totalPendingAmount = $totalPendingAmount+$games['amount'];
            }
            if($games['status'] == "success"){
                $totalAmount += $games['amount'];
            }
        }
        
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        $resArray['totalPendingAmount']=number_format($totalPendingAmount,2);
        
        return view('admin.money_pending',['data'=>$data,'udata'=>$udata,'res'=>$resArray]);
    }
    public function money_request_reject($id)
    {
        $data = Withdraws::findOrfail($id);
        $data->status ="reject";
        $data->save();
        
        $data = Withdraws::orderBy('date', 'DESC')->get();
        $udata = User_Data::all();
       
        $resArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        $totalPendingAmount=0;
        foreach($data as $games){
            $gameDate=date_create(date("Y-m-d",strtotime($games['date']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
            
            if($diff==0){
                if($games['status'] == "pending"){
                    $todayAmount=$todayAmount+$games['amount'];
                }
            }elseif($diff>=30){
                if($games['status'] == "pending"){
                    $lastAmount = $lastAmount+$games['amount'];
                }
            }
            if($games['status'] == "pending"){
                $totalPendingAmount = $totalPendingAmount+$games['amount'];
            }
            if($games['status'] == "success"){
                $totalAmount += $games['amount'];
            }
        }
        
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        $resArray['totalPendingAmount']=number_format($totalPendingAmount,2);
        
        return view('admin.money_pending',['data'=>$data,'udata'=>$udata,'res'=>$resArray]);
    }


    public function money_request_update(Request $request,$id)
    {
        $data = Withdraws::findOrfail($id);
        $data->status = $request->status;
        $data->save();
        return redirect('/money/pending');
    }

    public function commission()
    {
        $data = Commission::all();
        $udata = User_Data::all();
        $resArray=array();
      
        $gamecommission=game_commission::first();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        foreach($data as $com){
            
            $gameDate=date_create(date("Y-m-d",strtotime($com['createdAt']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
           
            if($diff==0){
                $todayAmount=$todayAmount+$com['commission'];
            }elseif($diff>=30){
                $lastAmount = $lastAmount+$com['commission'];
            }
            $totalAmount += $com['commission']; 
        }
        
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);
        $resArray['totalAmount']=number_format($totalAmount,2);
        
        return view('admin.commission',['subadmin'=>'0','gamecommission'=>$gamecommission,'maindata'=>$resArray,'data'=>$resArray,'dataGames'=>$data,'udata'=>$udata]);
    }
    public function commissionSub()
    {
        $data = Commission::all();
        $udata = User_Data::all();
        $resArray=array();
        $resSubAdminArray=array();
        $subCommissionPArray=array();
        $today=date_create(date("Y-m-d"));
        $todayAmount=0;
        $lastAmount=0;
        $totalAmount=0;
        $subCommissionPArray=SubAdmin_Page::all();
        $gamecommission=game_commission::first();
        foreach($data as $com){
            $userInfo = User_Data::where("_id",$com['winneruser'])->first();
            $subCommissionPer=SubAdmin_Page::where("_id",$userInfo->subAdminId)->first();
           
            $gameDate=date_create(date("Y-m-d",strtotime($com['createdAt']->toDateTime()->format('r'))));
            $diff=date_diff($today,$gameDate);
            $diff=$diff->format("%a");
           
            if($diff==0){
                $todayAmount=$todayAmount+(($com['commission']*$subCommissionPer->commission)/100);
            }elseif($diff>=30){
                $lastAmount = $lastAmount+(($com['commission']*$subCommissionPer->commission)/100);
            }
            $totalAmount += (($com['commission']*$subCommissionPer->commission)/100); 


            if (array_key_exists($userInfo->subAdminId,$resSubAdminArray))
            {
                $resSubAdminArray[$userInfo->subAdminId]['commission']=$resSubAdminArray[$userInfo->subAdminId]['commission']+(($com['commission']*$subCommissionPer->commission)/100);
            }
            else
            {
                $resSubAdminArray[$userInfo->subAdminId]['commission']=(($com['commission']*$subCommissionPer->commission)/100);
            }
           
        }
        
        $resArray['todaySum']=number_format($todayAmount,2);
        $resArray['lastMonth']=number_format($lastAmount,2);

       
        $dataSubPages="";
        if(Session::has('subadmin')){
            $dataSubPages = SubAdmin_Page::where("_id",Session::get('subadminid'))->first();
            if (array_key_exists(Session::get('subadminid'),$resSubAdminArray))
            {
                $resArray['totalAmount']=number_format($resSubAdminArray[Session::get('subadminid')]['commission'],2);
            }else{
                $resArray['totalAmount']=0;
            }
            
        }else{
            $resArray['totalAmount']=number_format($totalAmount,2);
        }
        
        
        return view('admin.commission',['subadmin'=>'1','gamecommission'=>$gamecommission,
                                        'maindata'=>$resArray,'data'=>$dataSubPages,'dataGames'=>$data,
                                        'udata'=>$udata,'subdata'=>$subCommissionPArray,'resSubAdminArray'=>$resSubAdminArray]);
    }
    
    public function gamecommission(Request $request){

        $gamecommission=game_commission::all();
        $gamecommission->gamecommission = $request->gamecommission;
        $data->save();

    }
    public function sub_admin()
    {
        return view('admin.add_subadmin');
    }

    public function sub_admin_create(Request $request)
    {
        echo "<pre>";
        print_r($request->toArray());
        die;
    }
}
