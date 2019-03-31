<?php

namespace App\Http\Controllers\Api;

use App\Model\Lead;
use App\Model\LeadProcess;
use App\Model\Region;
use App\Model\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;
use Log;
use Validator;

class LeadsAPIController extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/
    public function index(){
        $leads = Lead::getAllLead();

        return $leads;
    }

    public function leadsByTipster($id, Request $request){
        $productId = "";
        if(isset($request->product_id)){
            $productId = $request->product_id;
        }
        $statusId = "";
        if(isset($request->status_id)){
            $statusId = $request->status_id;
            if(strpos($statusId, ',') !== false){
                $statusId = explode(',',$statusId);
            }
        }
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $leads = Lead::leadsByTipster($id,$productId,$statusId, $fromDate, $toDate);
        $tipster = User::find($id);
        foreach ($leads as $lead) {
            $lead->date = Common::dateFormat($lead->created_at, 'd/m/Y');

            if(isset($tipster) && $tipster->preferred_lang == 'vn'){
                $lead->status_text = Common::showNameStatusVN($lead->status);
            }else{
                $lead->status_text = Common::showNameStatus($lead->status);
            }
            $lead->status_color = Common::colorStatus($lead->status);
        }
        return $leads;
    }

    public function add($tipsterId){
        $regions = Region::getAllRegion();
        $products = Product::getProducts();
        $tipsters = User::getUserByID($tipsterId);
        $jsonValue = [
            "regions" => $regions,
            "products" => $products,
            "tipsters" => $tipsters
        ];
        return response()->json($jsonValue, 201);
    }

    public function edit($tipsterId, $leadId){
        $regions = Region::getAllRegion();
        $products = Product::getProducts();
        $tipsters = User::getUserByID($tipsterId);
        $lead = Lead::getLeadByID($leadId);
        $jsonValue = [
            "regions" => $regions,
            "products" => $products,
            "tipsters" => [$tipsters],
            "lead" => $lead
        ];
        return response()->json($jsonValue, 201);
    }

    public function show($id){
        $lead = Lead::getLeadByID($id);
        $historys = LeadProcess::getStatusByLead($id);
        $historyItemNew = new LeadProcess();
        $historyItemNew["status_id"] = 0;
        $historyItemNew["created_at"] = $lead->created_at;
        $historys->push($historyItemNew);
        foreach ($historys as $historyItem) {
            $historyItem->status_name = Common::showNameStatus($historyItem->status_id);
            $historyItem->date = Common::dateFormat($historyItem->created_at, 'd-M-Y H:i');
            $historyItem->lable_status = Common::showColorStatus($historyItem->status_id);
        }
        $lead->historys = $historys;
        return $lead;
    }

    public function store(Request $request)
    {
        $value = $request->json()->all();
        // foreach ($value as $key => $value) {
        //     $request->fullname = $value;
        // }
        Log::info($value);
        $rules = [
            'fullname' => 'required',
            'relationship' => 'required',
            'email' => 'required_if:phone,==,|string|email|max:255',
            'phone' => 'min:11|numeric',
            'region_id' => 'required',
            'tipster_id' => 'required',
            'product_id' => 'required'
        ];
        $message = [
            'email.required_if' => 'Please enter email or phone number.',
            'product_id' => 'Please chose product'
        ];

        $validator = Validator::make($value,$rules,$message);
        if (!$validator->fails())
        {
            $productIds = explode(',', $value['product_id']);

            if(count($productIds) > 0){
                foreach ($productIds as $key => $productIdItem) {
                    $lead['fullname'] = $value["fullname"];
                    $lead['relationship'] = $value["relationship"];
                    $lead['email'] = $value["email"];
                    if(isset($value["birthday"])){
                        $lead['birthday'] = $value["birthday"];
                    }
                    if(isset($value["gender"])){
                        $lead['gender'] = $value["gender"];
                    }
                    
                    $lead['phone'] = $value["phone"];
                    if(isset($value["address"])){
                        $lead['address'] = $value["address"];
                    }
                    
                    $lead['notes'] = $value["notes"];
                    $lead['product_id'] = $productIdItem;
                    $lead['status'] = 0;
                    $lead['region_id'] = $value["region_id"];
                    $lead['tipster_id'] = $value["tipster_id"];
                    $leadnew = Lead::create($lead);
                }
            }
            
            $new = Utils::$lead_process_status_new;

            $jsonValue = [
                "message" => "create lead success",
                "status" => "0"
            ];
            return response()->json($jsonValue, 201);
        }
        $jsonValue = [
            "message" => "Create lead fail. Please, try again",
            "status" => "1",
            "error" => $validator->messages()
        ];
        return response()->json($jsonValue, 201);
    }

    public function update(Request $request)
    {
        $value = $request->json()->all();
        Log::info($value);
        $rules = [
            'fullname' => 'required',
            'email' => 'required_if:phone,==|string|email|max:255',
            'phone' => 'required_if:email,==',
            'region_id' => 'required',
            'tipster_id' => 'required'
        ];
        $message = [
            'email.required_if' => 'Please enter email or phone number.',
            'phone.required_if' => 'Please enter email or phone number.'
        ];

        $validator = Validator::make($value,$rules,$message);
        if (!$validator->fails())
        {
            $lead = Lead::find($value["id"]);
            Log::info($lead);
            if(isset($lead)){
                $lead->fullname = $value["fullname"];
                $lead->relationship = $value["relationship"];
                $lead->email = $value["email"];
                if(isset($value["gender"])){
                    $lead->gender = $value["gender"];
                }
                $lead->phone = $value["phone"];
                $lead->notes = $value["notes"];
                $lead->product_id = $value["product_id"];
                $lead->region_id = $value["region_id"];
                $lead->tipster_id = $value["tipster_id"];
                Log::info($lead);
                $lead->update();
            }
            $jsonValue = [
                "message" => "update lead success",
                "status" => "0"
            ];
            return response()->json($jsonValue, 200);
        }
        $jsonValue = [
            "message" => "update lead fail",
            "status" => "1"
        ];
        return response()->json($jsonValue, 200);
    }

    public function delete($leadId)
    {
        $lead = Lead::getLeadByID($leadId);
        if($lead){
            $lead->delete_is = 1;
            $lead->save();
            $jsonValue = [ "message" => "delete lead success", "status" => "0"];
        }else{
            $jsonValue = [ "message" => "delete lead failed", "status" => "1"];
        }
        return response()->json($jsonValue, 201);
    }
}
