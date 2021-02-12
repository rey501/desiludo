<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_Data;
use App\SubAdmin_Page;
use App\Commission;
class Sub_AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubAdmin_Page::where('isActive','true')
            ->orderBy('createdAt','DESC')
            ->get();
        $totalsubamdin = SubAdmin_Page::all()->count();
        $activesubamdin = SubAdmin_Page::all()->where("isActive","true")->count();
        $inactivesubamdin = SubAdmin_Page::all()->where("isActive","false")->count();

        $totalLimitsubamdin = 0;
        
        foreach($data as $subadmin){
            $totalLimitsubamdin=$totalLimitsubamdin+$subadmin->amountbalance;
            $userdata = User_Data::all()->where("subAdminId",$subadmin->_id);
            $userbalance = 0;
            foreach($userdata as $user){
                $userbalance=$userbalance+$user->points;
            }
            $subadmin->userbalance=$userbalance;

            $commissionsubamdinAmt = Commission::all();
            $subcommissionamt = 0;
            foreach($commissionsubamdinAmt as $commi){
                $subcommissionamt=$subcommissionamt+$commi->commission;
            }

            $subadmin->subcommissionamt=$subcommissionamt;
        }

        $commissionsubamdin = Commission::all();
        $totalCommission = 0;
        foreach($commissionsubamdin as $comSub){
            $totalCommission=$totalCommission+$comSub->commission;
        }

        
        
        return view('sub_admin.view_subadmin',
                                    [
                                        'data'=>$data,
                                        'totalsubamdin'=>$totalsubamdin,
                                        'activesubamdin'=>$activesubamdin,
                                        'totalLimitsubamdin'=>$totalLimitsubamdin,
                                        'totalCommission'=>$totalCommission,
                                        'inactivesubamdin'=>$inactivesubamdin
                                    ]
                    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('sub_admin.add_subadmin',['error'=>'']);
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
        $data = User_Data::findOrfail($id);  
        $dataPages = SubAdmin_Page::where('adminid', '=', $id)->first(); 
        
        if ($dataPages!=null) {
            //echo 'No records found'.count($dataPages);
            $data->userPage=$dataPages->userPage;
            $data->commissionPage=$dataPages->commissionPage;
            $data->tournamentPage=$dataPages->tournamentPage;
            $data->botsPage=$dataPages->botsPage;
            $data->cleardataPage=$dataPages->cleardataPage;

        }
        
        return view('sub_admin.edit_sub_admin',['edata'=>$data]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function set_coin_create()
    {
        return view('admin.add_setcoin');
    }

    public function set_coin_list()
    {
        return view('admin.view_setcoin');
    }

    public function sub_admin_edit($id)     
    {
        $data = SubAdmin_Page::where('_id',$id)
                    ->get();
        $data = $data[0];
        return view('sub_admin.edit_sub_admin',['edata'=>$data]);
    }

    public function AddNewSubadmin(Request $request){
        $data = SubAdmin_Page::where('email', '=', $request->email)->count();

       
        if ($data >0) {
            $data=array();
            return view('sub_admin.add_subadmin',['error'=>"email already exists",'data'=>$data]);
        }else{
            $data = array(
                "adminname"=> $request->name,
                "email"=> $request->email,
                "password"=> $request->password,
                "mobileno"=> $request->mobileno,
                "commission"=> $request->commission,
                "userPage"=> $request->userPage,
                "amountbalance"=>$request->amountbalance,
                "commissionPage"=> $request->commissionPage,
                "tournamentPage"=> $request->tournamentPage,
                "botsPage"=>$request->botsPage,
                "cleardataPage"=>$request->cleardataPage,
                "isActive"=>"true",
            );
            SubAdmin_Page::insert($data);
    
            $data = SubAdmin_Page::All();
            return view('sub_admin.view_subadmin',['error'=>'','data'=>$data]);
        }
        
    }

    public function sub_admin_update($id,Request $request)
    {
        $data = SubAdmin_Page::where('_id', '=', $id)->first();
        if ($data!=null) {
            $data->adminname = $request->name;
            $data->email = $request->email;
            $data->password = $request->password;
            $data->mobileno = $request->mobileno;
            $data->amountbalance = $request->amountbalance;
            
            if($request->adddedecutbalance < 0){
                
                $data->currentbalance = ($request->currentbalance - abs($request->adddedecutbalance));
            }else{
                $data->currentbalance = ($request->currentbalance + $request->adddedecutbalance);
            }
            
            $data->commission = $request->commission;
            $data->isActive = $request->isActive;

            $data->userPage = $request->userPage;
            $data->commissionPage = $request->commissionPage;
            $data->tournamentPage = $request->tournamentPage;
            $data->botsPage = $request->botsPage;
            $data->cleardataPage = $request->cleardataPage;
            $data->save();
        }else{
            $data = array(
                "adminid"=>$id,
                "userPage"=> $request->userPage,
                "commissionPage"=> $request->commissionPage,
                "tournamentPage"=> $request->tournamentPage,
                "botsPage"=>$request->botsPage,
                "cleardataPage"=>$request->cleardataPage,
                "isActive"=>"true",
            );
            SubAdmin_Page::insert($data);
           

        }
        $data = SubAdmin_Page::All();
        $totalsubamdin = SubAdmin_Page::all()->count();
        $activesubamdin = SubAdmin_Page::all()->where("isActive","true")->count();
        $inactivesubamdin = SubAdmin_Page::all()->where("isActive","false")->count();

        $totalLimitsubamdin = 0;
        
        foreach($data as $subadmin){
            $totalLimitsubamdin=$totalLimitsubamdin+$subadmin->amountbalance;
            $userdata = User_Data::all()->where("subAdminId",$subadmin->_id);
            $userbalance = 0;
            foreach($userdata as $user){
                $userbalance=$userbalance+$user->points;
            }
            $subadmin->userbalance=$userbalance;

            $commissionsubamdinAmt = Commission::all();
            $subcommissionamt = 0;
            foreach($commissionsubamdinAmt as $commi){
                $subcommissionamt=$subcommissionamt+$commi->commission;
            }
            $subadmin->subcommissionamt=$subcommissionamt;
        }

        $commissionsubamdin = Commission::all();
        $totalCommission = 0;
        foreach($commissionsubamdin as $comSub){
            $totalCommission=$totalCommission+$comSub->commission;
        }

        return view('sub_admin.view_subadmin',
                                    [
                                        'data'=>$data,
                                        'totalsubamdin'=>$totalsubamdin,
                                        'activesubamdin'=>$activesubamdin,
                                        'totalLimitsubamdin'=>$totalLimitsubamdin,
                                        'totalCommission'=>$totalCommission,
                                        'inactivesubamdin'=>$inactivesubamdin
                                    ]
                    );
        //return view('sub_admin.view_subadmin',['data'=>$data]);
    }
}
