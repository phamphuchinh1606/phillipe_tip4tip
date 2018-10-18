<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Model\Assignment;
use App\Model\Lead;
//use Illuminate\Foundation\Auth\User;
use App\Model\LogActivity;
use App\Model\Product;
use App\Model\Role;
use App\Model\RoleType;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Common\RoleCommon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(isset($user)){
            return redirect()->route('dashboard');
        }else {
            return redirect()->route('login');
        }
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $roleAuth = Role::getInfoRoleByID($user->role_id);
        $isLoginTipster = RoleCommon::checkRoleTipster($roleAuth->code);

        if(RoleCommon::checkRoleAdmin($roleAuth->code)){
            $recentleads = Lead::getRecentLeads(5);
            $statusByRecentTipster = Lead::sumStatusByRecentLead(5);
        }else{
            if(RoleCommon::checkRoleaConsultant($roleAuth->code)){
                $recentleads = Lead::getRecentLeadsByConsultant($user->id,5);
                $statusByRecentTipster = Lead::sumStatusByConsultant($user->id,5);
            }else{
                $recentleads = Lead::getRecentLeadsByTipster($user->id,5);
                $statusByRecentTipster =  Lead::sumStatusByTipsterRecentLead($user->id,5);
            }
        }
        foreach ($recentleads as $recentlead){
            $recentlead->created_date = Common::dateFormat($recentlead->created_at,'d-M-Y');
            $recentlead->status_text = Common::showNameStatus($recentlead->status);
            $recentlead->status_color = Common::colorStatus($recentlead->status);
            $product = Product::getProductByID($recentlead->product_id);
            if(isset($product->name)){
                $recentlead->product = Product::getProductByID($recentlead->product_id)->name;
            }
        }

        $recenttipsters = User::getRecentTipsters(5);
//        $mostactivetipsters = User::getMostActiveTipsters(10);

        /*get 10 Tipsters had lead introduces are heightest*/
        $lead_sort = 'desc';
        if(isset($request->lead_sort)){
            $lead_sort = $request->lead_sort;
        }
        $mostactivetipsters = Lead::getTipsterHeighestLead($lead_sort,5);

//        dd($statusByRecentTipster);

        $highestPointTipsters = User::getHighestPointTipster();

        $new = 0;
        $newPersen = 0;
        $call =0;
        $callPersen = 0;
        $quote = 0;
        $quotePersen = 0;
        $win = 0;
        $winPersen = 0;
        $lost = 0;
        $lostPersen = 0;
        $totalCount = 0;
        foreach($statusByRecentTipster as $sumStatus){
            $totalCount+= $sumStatus->countStatus;
            switch ($sumStatus->status) {
                case 0:
                    $new = $sumStatus->countStatus;
                    break;
                case 1:
                    $call = $sumStatus->countStatus;
                    break;
                case 2:
                    $quote = $sumStatus->countStatus;
                    break;
                case 3:
                    $win = $sumStatus->countStatus;
                    break;
                case 4:
                    $lost = $sumStatus->countStatus;
                    break;
            }
        }
        if($new > 0) $newPersen = $new*100/$totalCount;
        if($call > 0) $callPersen = $call*100/$totalCount;
        if($quote > 0) $quotePersen = $quote*100/$totalCount;
        if($win > 0) $winPersen = $win*100/$totalCount;
        if($lost > 0) $lostPersen = $lost*100/$totalCount;

        /*Get log activities by role*/
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $logActivities = [];
        if($roleAuth->code == 'admin'){
            $logActivities = LogActivity::getAllLogs();
        }else{
            $logActivities = LogActivity::getLogActivityByUserID($auth->id);
        }

        foreach ($logActivities as $logActivity){
            $logActivity->user_name = User::getUserByID($logActivity->user_id)->username;
            $logActivity->fullname = User::getUserByID($logActivity->user_id)->fullname;
        }

        return view('admin.dashboard',compact('user',$user))->with([
            'recentleads' => $recentleads,
            'recenttipsters' => $recenttipsters,
            'highestPointTipsters' => $highestPointTipsters,
            'mostactivetipsters' => $mostactivetipsters,
            'statusByRecentTipster' => $statusByRecentTipster,
            'new' => $new,
            'call' => $call,
            'quote' => $quote,
            'win' => $win,
            'lost' => $lost,
            'newPersen' => $newPersen,
            'callPersen' => $callPersen,
            'quotePersen' => $quotePersen,
            'winPersen' => $winPersen,
            'lostPersen' => $lostPersen,
            'logActivities' => $logActivities,
            'isLoginTipster' => $isLoginTipster,
            'lead_sort' => $lead_sort
        ]);
    }

}
