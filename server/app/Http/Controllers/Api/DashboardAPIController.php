<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;
use App\Model\Lead;
use App\Model\Product;
use Log;
use Validator;

class DashboardAPIController extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/

    private function formatPersen($value, $sumValue){
        if($sumValue > 0){
            $persen = $value*100/$sumValue;
            return round($persen);
        }
        return 0;
    }

    public function dashboard($tipsterId, Request $request)
    {
        $productId = -1;
        if(isset($request->product_id)){
            $productId = $request->product_id;
        }
        $tipster = User::find($tipsterId);
        $recentleads = Lead::getRecentLeadsByTipster($tipsterId,5);
        foreach ($recentleads as $recentlead){
            $recentlead->created_date = Common::dateFormat($recentlead->created_at,'d-M-Y');
            if(isset($tipster) && $tipster->preferred_lang == 'vn'){
                $recentlead->status_text = Common::showNameStatusVN($recentlead->status);
            }else{
                $recentlead->status_text = Common::showNameStatus($recentlead->status);
            }
            $recentlead->status_color = Common::colorStatus($recentlead->status);
            $recentlead->product = Product::getProductByID($recentlead->product_id)->name;
        }

        $statusByRecentTipster = Lead::sumStatusByTipsterRecentLead($tipsterId,$productId,20);

        $new = 0;
        $colorNew = Common::colorStatus(0);
        $assign = 0;
        $colorAssign =  Common::colorStatus(5);
        $call =0;
        $colorCall = Common::colorStatus(1);
        $quote = 0;
        $colorQuote = Common::colorStatus(2);
        $win = 0;
        $colorWin = Common::colorStatus(3);
        $lost = 0;
        $colorLost = Common::colorStatus(4);
        $totalCount = 0;
        foreach($statusByRecentTipster as $sumStatus){
            $totalCount+= $sumStatus->countStatus;
            switch ($sumStatus->status) {
                case 0:
                    $new = $sumStatus->countStatus;
                    break;
                case 5:
                    $assign = $sumStatus->countStatus;
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

        $newPersen =  $this->formatPersen($new,$totalCount);
        $assignPersen = $this->formatPersen($assign,$totalCount);
        $callPersen =  $this->formatPersen($call,$totalCount);
        $quotePersen =  $this->formatPersen($quote,$totalCount);
        $winPersen =  $this->formatPersen($win,$totalCount);
        $lostPersen =  $this->formatPersen($lost,$totalCount);
        $statusLead = [
        	'new' => $new,
        	'colorNew' => $colorNew,
            'assign' => $assign,
            'colorAssign' => $colorAssign,
            'call' => $call,
            'colorCall' => $colorCall,
            'quote' => $quote,
            'colorQuote' => $colorQuote,
            'win' => $win,
            'colorWin' => $colorWin,
            'lost' => $lost,
            'colorLost' => $colorLost,
            'newPersen' => $newPersen,
            'assignPersen' => $assignPersen ,
            'callPersen' => $callPersen,
            'quotePersen' => $quotePersen,
            'winPersen' => $winPersen,
            'lostPersen' => $lostPersen,
        ];

        $jsonValue = [
        	"recentleads" => $recentleads,
        	"statusByRecentTipster" => $statusByRecentTipster,
        	"statusLead" => $statusLead
        ];

        return response()->json($jsonValue, 201);
    }
    
}
